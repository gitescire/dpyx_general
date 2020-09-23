<?php

namespace App\Mail;

use App\Models\Repository;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Category;
use App\Models\Subcategory;
use PDF;

class ReviewedRepositoryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $repository;
    public $certificationPDF;
    public $evaluationPDF;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;

        $evaluation = $repository->evaluation;
        $categories = Category::get();
        $subcategories = Subcategory::with(['questions.answers' => function ($query) use ($evaluation) {
            $query->where('evaluation_id', $evaluation->id);
        }])->get();

        $this->evaluationPDF = PDF::loadView('pdfs.evaluation', compact('repository', 'categories', 'subcategories'));
        $this->evaluationPDF->setPaper('Letter');
        $this->certificationPDF = PDF::loadView('pdfs.certification', compact('repository'));
        $this->certificationPDF->setPaper('Letter', 'landscape');

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = $this->markdown('mails.repositories.reviewed')
        ->subject('Repositorio Revisado')
            ->attachData($this->evaluationPDF->output(), 'evaluacion.pdf', [
                'mime' => 'application/pdf',
            ]);

        if (!is_null($this->certificationPDF)) {
            $message->attachData($this->certificationPDF->output(), 'certificacion.pdf', [
                'mime' => 'application/pdf',
            ]);
        }

        return $message;
    }
}
