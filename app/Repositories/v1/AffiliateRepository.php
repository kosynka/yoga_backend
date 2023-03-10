<?php

namespace App\Repositories\v1;

use App\Models\Affiliate;
use App\Repositories\Contracts\AffiliateRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class AffiliateRepository extends BaseRepository implements AffiliateRepositoryInterface
{
    public function __construct(Affiliate $model)
    {
        parent::__construct($model);
    }

    public function all(array $attributes): ?Collection
    {
        $query = $this->filter($attributes);

        $query->when(isset($attributes['city_id']), function ($query) use ($attributes) {
            $query->where('city_id', $attributes['city_id']);
        });

        $this->paginate($query, $attributes);
        $this->order($query, $attributes);

        return $query->get();
    }

    public function findWithFilter($attributes, int $id)
    {
        $query = $this->model::with('lessons');

        if (isset($attributes['starts_at'])) {
            // $query->leftJoin('lessons');
            $query->whereHas('lessons', function ($query) use ($attributes) {
                $query->whereDate('lessons.starts_at', 'like', $attributes['starts_at']);
            });
        }

        return $query->first();
    }

    private function filter($attributes)
    {
        return $this->model->when(isset($attributes['filter']), function ($query) use ($attributes) {
            $query->where('name', 'LIKE', '%' . $attributes['filter'] . '%')
                ->orWhere('description', 'LIKE', '%' . $attributes['filter'] . '%');
        });
    }
}
