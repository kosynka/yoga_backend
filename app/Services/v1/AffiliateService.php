<?php

namespace App\Services\v1;

use App\Http\Resources\AffiliateResource;
use App\Repositories\Contracts\AffiliateRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\AffiliateServiceInterface;

class AffiliateService extends BaseService implements AffiliateServiceInterface
{
    private AffiliateRepositoryInterface $repository;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        AffiliateRepositoryInterface $repository,
        UserRepositoryInterface $userRepository,
        )
    {
        parent::__construct();

        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function index(array $data)
    {
        $affiliates = $this->repository->all($data);

        $favorite = null;
        if (isset($this->user)) {
            $favorite = $this->user->favorite_affiliate_id;
        }

        return $this->result([
            'favorite_id' => $favorite,
            'affiliate' => AffiliateResource::collection($affiliates->load('instructors')),
        ]);
    }

    private function makeFavorite($id): void
    {
        $data['favorite_affiliate_id'] = $id;

        $this->userRepository->update($this->user, $data);
    }

    private function dissmissFavorite(): void
    {
        $data['favorite_affiliate_id'] = null;

        $this->userRepository->update($this->user, $data);
    }

    public function like(int $id)
    {
        if ($this->user->favorite_affiliate_id === $id) {
            $this->dissmissFavorite();
        } else {
            $this->makeFavorite($id);
        }

        return $this->ok();
    }

	public function show(array $data, int $id)
    {
        $affiliate = $this->repository->findWithFilter($data, $id);

        return $this->result([
            'affiliate' => (new AffiliateResource($affiliate->load('instructors'))),
        ]);
    }

    public function showFavorite()
    {
        if ($this->user->favorite_affiliate_id) {
            $affiliate = $this->repository->find($this->user->favorite_affiliate_id);
        } else {
            return $this->result(['affiliate' => null]);
        }

        return $this->result([
            'affiliate' => (new AffiliateResource($affiliate->load('lessons', 'instructors'))),
        ]);
    }
}