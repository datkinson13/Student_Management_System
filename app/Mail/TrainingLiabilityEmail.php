<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrainingLiabilityEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($business_roles, $courses, $users, $red_enrolments,
    $yellow_enrolments, $green_enrolments, $pending_enrolments, $completed_enrolments,
    $immediate_total, $approaching_total, $distant_total, $today)
    {
      $this->business_roles = $business_roles;
      $this->courses = $courses;
      $this->users = $users;
      $this->red_enrolments = $red_enrolments;
      $this->yellow_enrolments = $yellow_enrolments;
      $this->green_enrolments = $green_enrolments;
      $this->pending_enrolments = $pending_enrolments;
      $this->completed_enrolments = $completed_enrolments;
      $this->immediate_total = $immediate_total;
      $this->approaching_total = $approaching_total;
      $this->distant_total = $distant_total;
      $this->today = $today;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('training@canopi.com.au')
                  ->view('emails.trainingliability.email')
                  ->with([
                    'business_roles' => $this->business_roles,
                    'courses' => $this->courses,
                    'users' => $this->users,
                    'red_enrolments' => $this->red_enrolments,
                    'yellow_enrolments' => $this->yellow_enrolments,
                    'green_enrolments' => $this->green_enrolments,
                    'pending_enrolments' => $this->pending_enrolments,
                    'completed_enrolments' => $this->completed_enrolments,
                    'immediate_total' => $this->immediate_total,
                    'approaching_total' => $this->approaching_total,
                    'distant_total' => $this->distant_total,
                    'today' => $this->today
                  ]);
    }
}
