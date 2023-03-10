<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Curriculo;
use App\Mail\CurriculoMail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class CurriculoControllerTest extends TestCase
{
    use DatabaseMigrations;
    use  WithoutMiddleware;

    /**
     * A basic feature test example.
     * @test
     *
     */
    public function testSubmitForm()
    {
        Mail::fake();
        Storage::fake();

        $file = UploadedFile::fake()->create('arquivo.pdf', 500);

        $data = [
            'name' => 'Gabriel',
            'last_name' => 'Tavares',
            'phone' => '5584991028894',
            'email' => 'gabrieldvt@hotmail.com',
            'desiredjob' => 'Desenvolvedor',
            'schooling' => 'Mestrado',
            'comments' => 'Alguma coisa',
            'file' => $file
        ];

        $this->post('/curriculo', $data)
            ->assertRedirect('/');

        //$curriculo = Curriculo::find(1);

        //$this->assertTrue(Storage::disk()->exists($curriculo->file));
        //Mail::assertSent(CurriculoMail::class);
    }
    public function test_mailable_content()
    {
        $curriculo = Curriculo::create();
        $mailable = new CurriculoMail($curriculo);

        $mailable->assertFrom('contato@paytour.com.br');
    }
}
