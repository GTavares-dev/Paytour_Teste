<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Curriculo;
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
    public function test_submit_form_and_email()
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
            ->assertRedirect('/curriculo');


        $curriculo = Curriculo::find(1);

        $this->assertTrue(Storage::disk()->exists($curriculo->path));
        Mail::assertSent(CurriculoMail::class);
    }
    /**
     * A basic feature test example.
     * @test
     * @dataProvider DataProviderTests
     */
    public function test_submit_validation($data, $field)
    {
        $this->post('/curriculo', $data)
            ->assertSessionHasErrors($field);
    }
    public function DataProviderTests()
    {
        $file = UploadedFile::fake()->create('arquivo.pdf', 500);
        return [
            'should_not_send_without_name' => [
                'data' => [
                    'name' => '',
                    'last_name' => 'Tavares',
                    'phone' => '5584991028894',
                    'email' => 'gabrieldvt@hotmail.com',
                    'desiredjob' => 'Desenvolvedor',
                    'schooling' => 'Mestrado',
                    'comments' => 'Alguma coisa',
                    'file' => $file

                ],
                'field' => 'name'
            ],

            'should_not_send_without_last_name' => [
                'data' => [
                    'name' => 'Gabriel',
                    'last_name' => '',
                    'phone' => '5584991028894',
                    'email' => 'gabrieldvt@hotmail.com',
                    'desiredjob' => 'Desenvolvedor',
                    'schooling' => 'Mestrado',
                    'comments' => 'Alguma coisa',
                    'file' => $file

                ],
                'field' => 'last_name'
            ],

            'should_not_send_without_phone' => [
                'data' => [
                    'name' => 'Gabriel',
                    'last_name' => 'Tavares',
                    'phone' => 0,
                    'email' => 'gabrieldvt@hotmail.com',
                    'desiredjob' => 'Desenvolvedor',
                    'schooling' => 'Mestrado',
                    'comments' => 'Alguma coisa',
                    'file' => $file

                ],
                'field' => 'phone'
            ],

            'should_not_send_without_email' => [
                'data' => [
                    'name' => 'Gabriel',
                    'last_name' => 'Tavares',
                    'phone' => '5584991028894',
                    'email' => '',
                    'desiredjob' => 'Desenvolvedor',
                    'schooling' => 'Mestrado',
                    'comments' => 'Alguma coisa',
                    'file' => $file

                ],
                'field' => 'email'
            ],
            'should_not_send_without_desiredjob' => [
                'data' => [
                    'name' => 'Gabriel',
                    'last_name' => 'Tavares',
                    'phone' => '5584991028894',
                    'email' => 'gabrieldvt@hotmail.com',
                    'desiredjob' => '',
                    'schooling' => 'Mestrado',
                    'comments' => 'Alguma coisa',
                    'file' => $file

                ],
                'field' => 'desiredjob'
            ],
            'should_not_send_without_schooling' => [
                'data' => [
                    'name' => 'Gabriel',
                    'last_name' => 'Tavares',
                    'phone' => '5584991028894',
                    'email' => 'gabrieldvt@hotmail.com',
                    'desiredjob' => 'Desenvolvedor',
                    'schooling' => '',
                    'comments' => 'Alguma coisa',
                    'file' => $file

                ],
                'field' => 'schooling'
            ],
            'should_not_send_without_file' => [
                'data' => [
                    'name' => 'Gabriel',
                    'last_name' => 'Tavares',
                    'phone' => '5584991028894',
                    'email' => 'gabrieldvt@hotmail.com',
                    'desiredjob' => 'Desenvolvedor',
                    'schooling' => 'Mestrado',
                    'comments' => 'Alguma coisa',
                    'file' => ''

                ],
                'field' => 'file'
            ],

        ];
    }
    /**
     * @test
     * @dataProvider Filesnotallowed
     */
    public function test_validation_files($file)
    {
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
            ->assertSessionHasErrors();
    }
    public function Filesnotallowed($file)
    {
        $file = [
            'file.txt' => UploadedFile::fake()->create('file.txt', 300),
            'file.pdf' => UploadedFile::fake()->create('file.pdf', 2000),
            'file.jpg' => UploadedFile::fake()->create('file.jpg', 500)
        ];
        return [
            'FileTxtNotAllowed' => [
                'file' => $file['file.txt'],
            ],
            'FileSizePdfNotAllowed' => [
                'file' => $file['file.pdf'],
            ],
            'FileJpgNotAllowed' => [
                'file' => $file['file.jpg'],
            ],
        ];
    }
    /**
     * @test
     * @dataProvider FilesAllowed
     */
    public function test_validation_files_with_correct_types($file)
    {
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
            ->assertSessionHasNoErrors();
    }

    public function FilesAllowed()
    {
        $file = [
            'file.Pdf' => UploadedFile::fake()->create('file.pdf', 400),
            'file.Doc' => UploadedFile::fake()->create('file.doc', 300),
            'file.Docx' => UploadedFile::fake()->create('file.docx', 500)
        ];
        return [
            'Pdf' => [
                'file' => $file['file.Pdf']
            ],
            'Doc' => [
                'file' => $file['file.Doc']
            ],
            'Docx' => [
                'file' => $file['file.Docx']
            ],
        ];
    }
}
