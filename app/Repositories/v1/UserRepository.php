<?php

namespace App\Repositories\v1;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function all(array $attributes): ?Collection
    {
        $query = $this->filter($attributes);

        $query->when(isset($attributes['type']), function ($query) use ($attributes) {
            $query->where('role', $attributes['type']);
        });
        $query->when(isset($attributes['city_id']), function ($query) use ($attributes) {
            $query->whereHas('worksInAffiliate', function ($query) use ($attributes) {
                $query->where('city_id', $attributes['city_id']);
            });
        });
        $query->when(isset($attributes['affiliate_id']), function ($query) use ($attributes) {
            $query->where('works_in_affiliate_id', $attributes['affiliate_id']);
        });

        $query->where('role', '!=', User::ROLE_ADMIN);

        $this->paginate($query, $attributes);
        $this->order($query, $attributes);

        return $query->get();
    }

    public function findByPhone(string $phone): ?Model
    {
        return $this->model->where('phone', $phone)->first();
    }

    public function findWithFilter($attributes, int $id)
    {
        if (isset($attributes['starts_at'])) {
            $query = $this->model->with(['lessons' => function ($query) use ($attributes) {
                $query->whereDate('starts_at', $attributes['starts_at']);
            }]);
        } else {
            $query = $this->model;
        }

        $query->where('id', $id);

        return $query->first();
    }

    public function store(array $attributes): Model
    {
        $attributes['role'] = User::ROLE_USER;

        return $this->model->create($attributes);
    }

    public function update($model, array $attributes): Model
    {
        $model->update($attributes);
        $model->save();

        return $model;
    }

    public function destroy($model): void
    {
        $model->delete();
    }

    private function filter($attributes)
    {
        return $this->model->with('worksInAffiliate')->when(isset($attributes['filter']), function ($query) use ($attributes) {
            $query->where('name', 'LIKE', '%' . $attributes['filter'] . '%')
                ->orWhere('description', 'LIKE', '%' . $attributes['filter'] . '%');
        });
    }
}
