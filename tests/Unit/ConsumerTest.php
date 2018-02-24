<?php

namespace Tests\Unit;

use App\Soap\Auth;
use App\Soap\Consumer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class ConsumerTest extends TestCase
{
    function test_it_gets_books()
    {
        $client = Mockery::mock()
            ->shouldReceive('getBooks')
            ->once()
            ->andReturn(simplexml_load_string($this->getXml()))
            ->getMock();

        $auth = Mockery::mock(Auth::class);

        $consumer = new Consumer($client, $auth);

        $response = $consumer->getBooks();
        // Assert that the response is what we would expect...
        $this->assertEquals([
            [
                'Title' => 'The Alchemist',
            ], [
                'Title' => 'Veronica Decides To Die',
            ], [
                'Title' => 'The Second Machine Age',
            ],
        ], $response["Book"]);
    }

    private function getXml()
    {
        return <<<XML
    <GetBooksResponse>
        <Books>
            <Book>
                <Title>The Alchemist</Title>
            </Book>
            <Book>
                <Title>Veronica Decides To Die</Title>
            </Book>
            <Book>
                <Title>The Second Machine Age</Title>
            </Book>
        </Books>
    </GetBooksResponse>
XML;
    }
}
