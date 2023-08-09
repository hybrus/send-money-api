<?php

namespace App\Constants;


class TransactionConstant
{
    const Types = ["user", "bank"];

    const MinAmount = 0.1;

    const UserFee = 0.00;
    const InstaPayFee = 00.00;
    const PesoNetFee = 00.00;

    const InsufficientBalanceMesssage = "Insufficient Balance.";
    const SuccessMessage = "Success.";
    const ProviderUnvailabilityMessage = "Provider is Offline";
}
