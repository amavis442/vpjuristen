<?php

namespace Tests\Unit;

use Faker\Provider\DateTime;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;

use App\Dossier;
use App\Domain\Services\Dossier\DossierService;

// create a dossier with x invoices attached

/* add comments/actions to the dossier so you can see the progress
An action can be:
    - New dossier
    - reviewed dossier (accepted or rejected)
    - Normal procedure
        - Dossier open
            - Dossier will be reviewed for validety. This check can result in rejection, questions (maybe needs more motivation
                evidence that claim is valid) or acception
        - Contact with debtor
        - second contact
        - Communication with debtor/client
        - Go to court or not (feedback from client nescacerry becoz of extra costs)
        - Payment plan with debtor (also after feedback with client)
        - Impoundment, after ruling judge
        - Payment received (update sum collected and what is still open)
        - Dossier closed
            - because rejected (by us)
            - because client stopped (Client does not want to continue for any reason)
            - because claim has been fullfilled
*/


class DossierServiceTest extends TestCase
{
    protected $postData;
    protected $dossierId;
    protected $dossierService;

    public function setUp()
    {
        $this->createApplication();

        $this->postData['dossier'] = [
            'title' => 'Dossier' . date('YmdHis'),
            'dossierstatus_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->postData['invoice'] = [
            'title' => 'Invoice'.date('Y-m-d H:i:s'),
            'remarks' => 'None',
            'amount' => '100.00',
            'due_date' => '2017-01-15',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->dossierService = new DossierService();
    }


    /**
     * Should send email that dossier has been created and will be reviewed
     * Should be visible as new dossier in admin panel
     */
    public function testCreate()
    {
        $this->dossierService->setClientId(2);
        $this->dossierService->setDebtorId(3);

        $data['dossier'] = $this->postData['dossier'];
        $data['invoice'][] = $this->postData['invoice'];

        $request = Request::create(route('frontend.register.dossier.store'),'POST', $data, [], []);

        $dossier = $this->dossierService->create($request);

        $this->assertInstanceOf('App\Dossier', $dossier);

        $this->assertEquals($dossier['title'], $dossier->title);

        $this->dossierId = $dossier->id;
    }

    /**
     * Update existing dossier without creating new artifacts like invoices
     * @depends testCreate
     */
    public function testUpdate()
    {
        $this->dossierService->setClientId(2);
        $this->dossierService->setDebtorId(3);

        $data['dossier'] = $this->postData['dossier'];
        $data['dossier']['id'] = $this->dossierId;
        $dossier['title'] = 'Dossier-'.date('YmdHis');

        $data['invoices'][] = $this->postData['invoice'];
        $request = Request::create(route('frontend.register.dossier.store'),'POST', $data, [], []);
        $dossier = $this->dossierService->create($request);

        $this->assertInstanceOf('App\Dossier', $dossier);

        $this->assertEquals($dossier['title'], $dossier->title);


    }

    /**
     * Test interest calculation over 30 day period
     */
    public function testInterestRateCalc()
    {
        $dueDate = new \DateTime('-30 DAY');
        $days = (new \DateTime())->diff($dueDate)->d;
        $calculatedInterest = (0.08 * 1000 * $days) / 365;
        $interest = number_format($calculatedInterest,2);

        $this->assertEquals(6.58 ,$interest);
    }

    /**
     * Add an invoice to an existing dossier
     * Check if invoice date +2 weeks has been past
     * Add sum to total sum of claim
     * Add % interest rates of x days
     * Log the change
     */
    public function testAddInvoice()
    {
        $dossier_id = $this->dossierService->addDossier($this->postData['dossier']);
        $invoice = $this->postData["invoice"];
        $dueDate = new \DateTime('-30 DAY');
        $invoice['due_date'] = $dueDate->format('Y-m-d');
        $invoice['amount'] = '100.00';
        $invoice_id = $this->dossierService->addInvoice($dossier_id, $this->postData["invoice"]);

        $this->dossierService->setInterestRate(8);
        $this->dossierService->setLegalCollectionRate(40);
        $this->dossierService->setPaymentDays(14); // Reminder after these n days that after Terminal payment days the interestrate is in effect
        $this->dossierService->setTerminalPaymentDays(7);
        $interestFromService = $this->dossierService->getInterestInvoice($invoice_id);

        /* 8% per year interest */
        /* Duedate is the date the interest rate is in effect */
        $days = (new \DateTime())->diff($dueDate)->d;
        $calculatedInterest = (0.08 * 100 * $days) / 365;
        $interest = number_format($calculatedInterest,2);

        $this->assertEquals($interest, $interestFromService);
    }

    /**
     * Remove sum from total
     * Stop calculating interest rates
     * Log the change
     * Make invoice invisible from dashboard and admin panel. Only superadmin can still see the deleted invoice
     */
    public function testAddAndDeleteInvoice()
    {
        $dossier_id = $this->dossierService->addDossier($this->postData['dossier']);
        $invoice = $this->postData["invoice"];
        $invoice['amount'] = '100.00';
        $invoice1_id = $this->dossierService->addInvoice($dossier_id, $this->postData["invoice"]);
        $invoice['amount'] = '130.00';
        $invoice2_id = $this->dossierService->addInvoice($dossier_id, $this->postData["invoice"]);

        $sumDossier = $this->dossierService->getTotalSum($dossier_id);

        $this->assertEquals(230.00, $sumDossier);

        $this->dossierService->delInvoice($invoice1_id);

        $sumDossier = $this->dossierService->getTotalSum($dossier_id);

        $this->assertEquals(130.00, $sumDossier);
    }

    /**
     * Dossier is being reviewed and some questions arose and client should
     * first answer those before continue review process
     */
    public function testChangeStatusToPending()
    {

    }


    /**
     * Dossier has been accepted as is
     * Should send email of acceptance
     * Should be visible in admin panel
     */
    public function testChangeStatusToAccepted()
    {

    }

    /**
     * Dossier has been rejected because of: claim not valid, no change to ever win this, claim can not
     * be enforced by law (anymore)
     *
     */
    public function testChangeStatusToRejected()
    {

    }

    /**
     * Contact with debtor and results of that contact. Contact will be first by email/letter and if necessary
     * by phone
     */
    public function testAddActionFirstContact()
    {

    }

    /**
     * Debtor has agreed or suggested an paymentplan
     * This should first be reviewed
     */
    public function testAddActionPayment()
    {

    }

    /**
     * Paymentplan has been accepted and agenda with dates has been set
     * Notification of payment will be send 2 days before and checked 1 day after payment is due.
     * Without payment after payment is due, legal actions will be taken
     */
    public function testInitPaymentPlan()
    {

    }

    public function testPaymentPlanNotification()
    {

    }

    public function testPaymentPlanToLateNotification()
    {

    }

    public function testPaymentReceivedInTotal()
    {

    }


    public function testPaymentReceivedPartly()
    {


    }

}

