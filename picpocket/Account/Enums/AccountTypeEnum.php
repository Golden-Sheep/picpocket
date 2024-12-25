<?php

namespace PicPocket\Account\Enums;

/**
 * Enum AccountTypeEnum
 *
 * Defines the account types for the application.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
enum AccountTypeEnum: string
{
    /**
     * Represents a physical account (Pessoa Fisica).
     */
    case PHYSICAL = 'pf';

    /**
     * Represents a legal account (Pessoa Juridica).
     */
    case LEGAL = 'pj';
}
