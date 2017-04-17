<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DossierServiceTest extends TestCase
{
    public function setUp()
    {
        $this->createApplication();

    }

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

    /**
     * Should send email that dossier has been created and will be reviewed
     * Should be visible as new dossier in admin panel
     */
    public function testCreate()
    {

    }

    /**
     * Update existing dossier without creating new artifacts like invoices
     */
    public function testUpdate()
    {

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

    }

    /**
     * Remove sum from total
     * Stop calculating interest rates
     * Log the change
     * Make invoice invisible from dashboard and admin panel. Only superadmin can still see the deleted invoice
     */
    public function testDeleteInvoice()
    {

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

