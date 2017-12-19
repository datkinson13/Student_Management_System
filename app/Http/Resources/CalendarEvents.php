<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CalendarEvents extends Resource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id'    => $this->getId(),
            'title' => $this->getTitle(),
            'start' => $this->getStart()->toDateString(),
            'end'   => $this->getEnd()->toDateString(),
            'color' => $this->color,
        ];
    }
}

/*
    {
        events: [
            {
                title: 'Event1',
                start: '2011-04-04'
            },
            {
                title: 'Event2',
                start: '2011-05-05'
            }
        ],
        color: 'yellow',   // an option!
        textColor: 'black' // an option!
    }
*/