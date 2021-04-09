<?php
namespace Wind\Csnd\Domain\Validator;

class UserValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator
{
    public function isValid($user)
    {
        if (! $user instanceof \Wind\Csnd\Domain\Model\User) {
            $this->addError('The given Object is not a User.', 1262341470);
        }

        if ($user->getPassword() !== $user->getConfirmPassword()) {
            $this->addError('The passwords do not match.', 1262341707);
        }
    }
}