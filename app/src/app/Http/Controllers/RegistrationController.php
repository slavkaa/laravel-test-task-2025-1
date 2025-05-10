<?php

namespace App\Http\Controllers;

use App\DTOs\Factories\RegistrationLinkDtoFactory;
use App\Http\Requests\Registration\CreateRegistrationLinkRequest;
use App\Http\Requests\Registration\DeactivateRegistrationLinkRequest;
use App\Http\Requests\Registration\PageARequest;
use App\Services\Registration\RegistrationLinkManagementServiceInterface;

class RegistrationController extends AbstractController
{
    public function __construct(
        protected RegistrationLinkManagementServiceInterface $registrationService,
        protected RegistrationLinkDtoFactory                 $createUserRegistrationLinkDtoFactory,
    ) { }

    public function show(): object
    {
        return view('pages/registration/show');
    }

    public function pageA(PageARequest $request): object
    {
        try {
            $this->registrationService->checkLinkByHash($request->getHash());
        } catch (\Throwable $e) {
            return redirect()->route('registration.show')
                ->withErrors(['general' => $e->getMessage()]);
        }

        return view('pages/registration/page_a', [
            'hash' =>  $request->getHash(),
        ]);
    }

    public function createHash(CreateRegistrationLinkRequest $request): object
    {
        $url = $this->registrationService->createLinkByUserData(
            $this->createUserRegistrationLinkDtoFactory->createByCreateRegistrationLinkRequest($request)
        );

        if (empty($url)) {
            return response()->json([
                'error' => 'Error while link generation.',
            ]);
        } else {
            return response()->json([
                'data' => [
                    'url' => $url,
                ],
            ]);
        }
    }

    public function deactivateHash(DeactivateRegistrationLinkRequest $request): object
    {
        $this->registrationService->deactivateLink(
            $request->getHash()
        );

        return response()->json([]);
    }
}
