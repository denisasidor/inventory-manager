<?php

namespace App\Mail;
use App\Models\Item;



use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LowStockAlert extends Mailable
{
    use Queueable, SerializesModels;

    public Item $item;
    public function __construct(Item $item)
    {
        $this->item = $item;
    }
    public function build()
    {
        return $this->subject('⚠️ Low Stock Alert: ' . $this->item->name)
            ->view('emails.low-stock-alert');
    }
    /**
     * Get the message envelope.
     */

}
