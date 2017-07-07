<?php

namespace Tests\Unit;

use App\Repositories\Eloquent\ActionRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActionRepositoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $actionRepository = new ActionRepository();

        $actions = $actionRepository->getActionsByDossierId(4);

        foreach ($actions as $action) {
            //var_dump($action->comments->first());
            $this->assertInstanceOf('App\Models\Action',$action);
        }
    }
}
