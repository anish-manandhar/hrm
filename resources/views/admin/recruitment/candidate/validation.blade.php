@push('css')
    <style>
        .jquery-error {
            font-size: small;
        }
    </style>
@endpush
@push('js')
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.needs-validation').validate({
                errorPlacement: function (label, element) {
                    label.addClass('jquery-error text-danger mt-1');
                    label.insertAfter(element);
                },
                wrapper: 'span',
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    alt_email: {
                        required: false,
                        email: true,
                        notEqualTo: email,
                    },
                    phone: {
                        required: true,
                        maxlength: 10,
                        minlength: 10,
                    },
                    alt_phone: {
                        required: false,
                        maxlength: 10,
                        minlength: 10,
                        notEqualTo: phone,
                    },
                    salary_expectation: {
                        required: true,
                        digits: true,
                    },
                    salary_period: {
                        required: true,
                    },
                    duty_type: {
                        required: true,
                    },
                    shortlisted: {
                        required: true,
                    },
                    job_opening_id: {
                        required: true,
                    },
                    dob: {
                        required: false,
                    },
                    marital_status: {
                        required: false,
                    },
                    gender: {
                        required: false,
                    },
                    pan: {
                        required: false,
                    },
                    citizenship: {
                        required: false,
                    },
                    street_address: {
                        required: true,
                    }, 
                    worked_before: {
                        required: false,
                    },  
                    organization_name: {
                        required: false,
                    },                
                    organization_contact: {
                        required: false,
                        digits: true,
                        maxlength: 10,
                        minlength: 10,
                    }, 
                    organization_address: {
                        required: false,
                    }, 
                    hr_name: {
                        required: false,
                    }, 
                    hr_contact: {
                        required: false,
                        digits: true,
                        maxlength: 10,
                        minlength: 10,
                    },
                },
            });
        });
    </script>
@endpush
