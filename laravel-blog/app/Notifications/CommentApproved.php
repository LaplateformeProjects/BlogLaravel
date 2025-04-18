<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentApproved extends Notification
{
    use Queueable;

    protected $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre commentaire a été approuvé')
            ->greeting('Bonjour ' . ($this->comment->author ?? 'cher utilisateur') . ',')
            ->line('Votre commentaire a été approuvé et est désormais visible publiquement sur l’article :')
            ->line('"' . $this->comment->article->title . '"')
            ->action('Voir l’article', url(route('articles.show', $this->comment->article->slug)))
            ->line('Merci pour votre participation !');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'comment_id' => $this->comment->id,
            'article_id' => $this->comment->article_id,
        ];
    }
}
