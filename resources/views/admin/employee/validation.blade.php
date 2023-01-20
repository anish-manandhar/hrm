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
                    status: {
                        requried: true,
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
                    father_name: {
                        required: false,
                    },
                    father_contact: {
                        required: false,
                        maxlength: 10,
                        minlength: 10,
                    },
                    mother_name: {
                        required: false,
                    },
                    mother_contact: {
                        required: false,
                        maxlength: 10,
                        minlength: 10,
                    },
                    temporary_address: {
                        required: true,
                    },
                    permanent_address: {
                        required: true, 
                    },
                    department_id: {
                        required: true,
                    },
                    division_id: {
                        required: true,
                    },
                    joining_date: {
                        required: true,
                    },
                    salary: {
                        required: true,
                    },
                    salary_period: {
                        required: true,
                    },
                    duty_type: {
                        required: true,
                    },
                    dob: {
                        required: true,
                    },
                    marital_status: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                    blood_group: {
                        required: false,
                    },
                    password: {
                        required: true,
                        minlength: 7,
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 7,
                        equalTo: "#password",
                    },
                    pan: {
                        required: false,
                    },
                    citizenship: {
                        required: false,
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
                    emergency_contact_person_name: {
                        required: true,
                    },
                    emergency_contact_person_contact: {
                        required: true,
                        digits: true,
                        maxlength: 10,
                        minlength: 10,
                    },
                    emergency_contact_person_address: {
                        required: true,
                    },
                    emergency_contact_person_relation: {
                        required: true,
                    },
                    bank_name: {
                        required: false,
                    },
                    account_holder_name: {
                        required: false,
                    },
                    bank_branch: {
                        required: false,
                    },
                    bank_account_no: {
                        required: false,
                        digits: true,
                    },
                    bank_remarks: {
                        required: false,
                    },
                    college_name: {
                        required: true,
                    },
                    college_address: {
                        required: true,
                    },
                    completion_year: {
                        required: true,
                        digits: true,
                    },
                    highest_degree_name: {
                        required: true,
                    },
                    degree_document: {
                        required: true,
                    },
                },
            });
        });
    </script>
@endpush
