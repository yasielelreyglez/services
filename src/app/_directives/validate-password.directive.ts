import {Directive, forwardRef, Attribute} from '@angular/core';
import {Validator, AbstractControl, NG_VALIDATORS} from '@angular/forms';

@Directive({
    selector: '[app-validateEqual][formControlName],[app-validateEqual][formControl],[app-validateEqual][ngModel]',
    providers: [
        {provide: NG_VALIDATORS, useExisting: forwardRef(() => EqualValidator), multi: true}
    ]
})

export class EqualValidator implements Validator {
    constructor(@Attribute('app-validateEqual') public validateEqual: string,
                @Attribute('reverse') public reverse: string) {

    }

    private get isReverse() {
        if (!this.reverse) return false;
        return this.reverse === 'true' ? true : false;
    }

    validate(c: AbstractControl): { [key: string]: any } {
        // self value
        const actual = c.value;

        // control value
        const contrario = c.root.get(this.validateEqual);

        // value not equal
        if (contrario && actual !== contrario.value && !this.isReverse) {
            // console.log('entro');
            return {
                validateEqual: false
            };
        }

        // value equal and reverse
        if (contrario && actual === contrario.value && this.isReverse) {
            delete contrario.errors['validateEqual'];
            if (!Object.keys(contrario.errors).length) contrario.setErrors(null);
        }

        // value not equal and reverse
        if (contrario && actual !== contrario.value && this.isReverse) {
            contrario.setErrors({
                validateEqual: false
            });
        }

        return null;
    }
}
