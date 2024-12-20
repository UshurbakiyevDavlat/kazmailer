<?php

namespace App\Services;

use App\Models\Subscription;
use App\Models\User;

interface PaymentServiceInterface
{
    /**
     * Создать подписку для пользователя.
     *
     * @param User $user
     * @param string $paymentMethod
     * @param int $plan_id
     * @return Subscription
     */
    public function createSubscription(User $user, string $paymentMethod, int $plan_id): Subscription;

    /**
     * Отменить подписку пользователя.
     *
     * @param Subscription $subscription
     * @param string|null $reason
     * @return bool
     */
    public function cancelSubscription(Subscription $subscription, ?string $reason = null): bool;

    /**
     * Вернуть средства за подписку.
     *
     * @param Subscription $subscription
     * @param float $amount
     * @return bool
     */
    public function refund(Subscription $subscription, float $amount): bool;
}
