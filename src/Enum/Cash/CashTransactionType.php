<?php

namespace App\Enum\Cash;

use App\Trait\Core\EnumLabelTrait;

enum CashTransactionType: int
{
    use EnumLabelTrait;
    
    case Income = 1;
    case Expense = 2;
    
    public function getLabel(): string
    {
        return match($this) {
            self::Income => 'transactionTypeIncome',
            self::Expense => 'transactionTypeExpense',
        };
    }
    
    private function getDomain(): ?string
    {
        return 'cash';
    }
} 