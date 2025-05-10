<?php

namespace App\Services\Registration;

use App\DTOs\Registration\CreateRegistrationLinkDto;
use App\Ecxeptions\Registration\RegistrationLinkExpiredException;
use App\Ecxeptions\Registration\RegistrationLinkNotFoundException;
use App\Repositories\Registration\RegistrationLinkRepositoryInterface;
use Carbon\Carbon;

class RegistrationLinkManagementService implements RegistrationLinkManagementServiceInterface
{
    protected const TREE_DAYS_IN_SECONDS = 604800;

    public function __construct(
        protected HashService $hashService,
        protected RegistrationLinkRepositoryInterface $repository,
    )
    {}

    public function createLinkByUserData(CreateRegistrationLinkDto $dto): string
    {
        $hash = $this->hashService->generate();
        $this->storeHash($dto, $hash);

        return $this->generateLink($hash);
    }

    public function deactivateLink(string $hash): void
    {
        $link = $this->repository->findByHash(
            $hash
        );

        $link->is_active = false;
        $link->save();
    }

    /**
     * @throws RegistrationLinkNotFoundException
     * @throws RegistrationLinkExpiredException
     */
    public function checkLinkByHash(string $hash): void
    {
        $link = $this->repository->findByHash($hash);

        if (empty($link)) {
            throw new RegistrationLinkNotFoundException();
        }

        if ($link->is_active === false) {
            throw new RegistrationLinkExpiredException();
        }

        $cutoff = Carbon::now()
            ->subSeconds(config('app.registration_link_life_time', static::TREE_DAYS_IN_SECONDS))
            ->toDateTimeString();

        if ($link->created_at < $cutoff) {
            throw new RegistrationLinkExpiredException();
        }
    }

    // --- protected ------------------------------------------------------------------------------

    protected function generateLink($hash): string
    {
        return route('registration.page_a.show', ['hash' => $hash]);
    }

    protected function storeHash(CreateRegistrationLinkDto $dto, string $hash): void
    {
        $this->repository->create(
            $dto->getUserName(),
            $dto->getPhoneNumber(),
            $hash
        );
    }
}
