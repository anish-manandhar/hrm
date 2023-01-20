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
                    title: {
                        required: true,
                    },
                    total_vacancies: {
                        required: false,
                    },
                    application_deadline: {
                        required: false,
                    },
                    salary: {
                        required: false,
                    },
                    experience: {
                        required: false,
                    },
                    skills: {
                        required: false,
                    },
                    image: {
                        required: false,
                    },
                    department_id: {
                        required: true,
                    },
                    designation_id: {
                        required: true,
                    },
                    division_id: {
                        required: false,
                    },
                    offerings: {
                        required: false,
                    },
                    description: {
                        required: false,
                    },
                },
            });
        });
    </script>
@endpush
