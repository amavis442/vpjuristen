<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 4/17/17
 * Time: 12:24 PM
 */

namespace App\Domain\Services\Client;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Company;
use App\Contact;
use App\Role;
use App\User;
use Psy\Exception\RuntimeException;


class ClientService
{
    use ValidatesRequests;

    protected $client_id;
    protected $user;

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param int $client_id
     */
    public function setClientId(int $client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }


    public function getClient($id = 0)
    {
        if ($id === 0) {
            $id = $this->client_id;
        }

        if ($this->user instanceof User) {
            $company = $this->user->companies()->first();
        } else {
            $company = Company::findOrFail($id);
        }
        return $company;
    }


    public function store(Request $request)
    {
        $data = $request->get('company');
        /** @var Company $company */
        $company = Company::create($data);
        $currentTimestamp = date('Y-m-d H:i:s');;
        $data = $request->get('contact');
        $data['created_at'] = $currentTimestamp;
        $data['created_at'] = $currentTimestamp;
        /** @var Contact $contact */
        $contact = $company->contacts()->create($data);

        $userData = [];
        $userData['name'] = $contact->name;
        $userData['email'] = $contact->email;
        $userData['password'] = bcrypt('secret');
        $userData['active'] = 1;
        $userData['status'] = 'pending';
        $userData['created_at'] = $currentTimestamp;
        $userData['updated_at'] = $currentTimestamp;
        /** @var User $user */
        $user = $company->users()->withTimestamps()->create($userData);
        $user->roles()->withTimestamps()->attach(Role::where(['name' => 'prospect'])->get()->first()->id);

        return $company->id;
    }

    public function update(Array $data)
    {
        if (is_array($data)) {
            /** @var Company $company */
            $company = Company::find($data['id']);
            unset($data['id']);
            $company->update($data);

            return $company;
        }
    }
}