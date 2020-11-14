<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Query\Builder;

trait Sortable
{
    public function toUp()
    {
        $this->swapNeighbors($this->getUpNeighbor());
    }

    public function toDown()
    {
        $this->swapNeighbors($this->getDownNeighbor());
    }


    /**
     * @return bool
     */
    protected function getDownNeighbor()
    {
        return $this->getNeighbor('>', 'DESC');
    }

    /**
     * @return mixed
     */
    protected function getUpNeighbor()
    {
        return $this->getNeighbor('<');
    }

    /**
     * @param $operator
     * @param string $sort
     * @return mixed
     */
    protected function getNeighbor($operator, $sort = 'ASC')
    {
        return self::where('order', $operator, $this->order)
            ->orderBy('order', $sort)
            ->first();
    }

    /**
     * @param $neighbor
     * @return bool
     */
    protected function swapNeighbors($neighbor)
    {
        if(!$neighbor)
            return false;

        $values = ['current' => $this->order, 'neighbor' => $neighbor->order];
        $this->order = $values['neighbor'];
        $neighbor->order = $values['current'];
        return $this->save() && $neighbor->save();
    }

    /**
     * @param Builder $query
     * @return Builder mixed
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}