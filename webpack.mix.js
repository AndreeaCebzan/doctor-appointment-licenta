const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

//copy folder
mix.copyDirectory('resources/assets/images', 'public/assets/image');
mix.copyDirectory('resources/assets/front/vendor/font-awesome/webfonts', 'public/assets/webfonts');
mix.copyDirectory('public/web/plugins/global/fonts', 'public/assets/css/fonts');
mix.copyDirectory('node_modules/intl-tel-input/build/img', 'public/assets/img');


// third-party css
mix.styles([
    'node_modules/izitoast/dist/css/iziToast.min.css',
    'node_modules/intl-tel-input/build/css/intlTelInput.css',
    'node_modules/flatpickr/dist/flatpickr.css',
    'node_modules/bootstrap-daterangepicker/daterangepicker.css',
    'node_modules/fullcalendar/main.min.css',
    'public/backend/css/vendor.css',
    'public/backend/css/fonts.css',
    'public/backend/css/3rd-party.css',
    'public/backend/css/3rd-party-custom.css',
], 'public/assets/css/third-party.css')

// third-party dark css
mix.styles([
    'node_modules/intl-tel-input/build/css/intlTelInput.css',
    'node_modules/bootstrap-daterangepicker/daterangepicker.css',
    'node_modules/fullcalendar/main.min.css',
    'public/backend/css/vendor.css',
    'node_modules/flatpickr/dist/flatpickr.css',
    'public/backend/css/fonts.css',
    'public/backend/css/3rd-party.css',
    'public/backend/css/3rd-party-custom.css',
    'public/backend/css/style.dark.bundle.css',
], 'public/assets/css/third-party-dark.css')

// backend pages css
mix.sass('resources/assets/scss/main.scss', 'public/assets/css/page.css').version()


// backend pages dark mode css
mix.sass('resources/assets/scss/main-dark-mode.scss', 'public/assets/css/page-dark.css').version()


//dark mode css
// mix.sass(
// 'resources/assets/front/scss/front-custom.scss',
// 'resources/assets/scss/custom-dark-mode.scss'
// , 'assets/css/dark-mode.css').version()

// // front third party css
// mix.styles([
//     'node_modules/intl-tel-input/build/css/intlTelInput.css',
// ], 'public/css/front-third-party.css').version()
//
//
// // front page css
// mix.sass('resources/assets/css/landing/custom.scss',
//     'public/css/front-pages.css').version()


// mix.copy('node_modules/datatables/media/css/jquery.dataTables.css',
//     'public/assets/css/jquery.dataTables.css');
mix.copy('node_modules/datatables/media/images', 'public/assets/images');
// mix.copy('node_modules/intl-tel-input/build/css/intlTelInput.css',
//     'public/assets/css/intl/css/intlTelInput.css');
// mix.copy('node_modules/intl-tel-input/build/css/intlTelInput.css',
//     'public/assets/css/intl/css/intlTelInput.css');
// mix.copyDirectory('node_modules/intl-tel-input/build/img',
//     'public/assets/css/intl/img');
// mix.babel('node_modules/datatables/media/js/jquery.dataTables.min.js',
//     'public/assets/js/jquery.dataTables.min.js');
// mix.babel('node_modules/moment/min/moment.min.js',
//     'public/assets/js/moment.min.js');
// mix.babel('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
//     'public/assets/js/bootstrap-datepicker/bootstrap-datepicker.js');
// mix.copy('resources/assets/front/style.css', 'public/assets/front/style.css');
// mix.copy('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css',
//     'public/assets/css/bootstrap-datepicker/bootstrap-datepicker.css');
// mix.copy('node_modules/apexcharts/dist/apexcharts.js',
//     'public/assets/js/apexcharts/apexcharts.js');
// mix.copy('node_modules/jquery/dist/jquery.min.js',
//     'public/assets/js/jquery/jquery.min.js');
mix.copyDirectory('resources/assets/front', 'public/assets/front');

// mix.babel('node_modules/intl-tel-input/build/js/intlTelInput.js',
//     'public/assets/js/intl/js/intlTelInput.min.js');
// mix.babel('node_modules/intl-tel-input/build/js/utils.js',
//     'public/assets/js/intl/js/utils.min.js');

mix.sass('resources/assets/scss/style.scss', 'assets/css/style.css').version();
// sass('resources/assets/scss/custom.scss', 'assets/css/custom.css').
// sass('resources/assets/scss/app.scss', 'assets/css/app.css').
// sass('resources/assets/front/scss/front-custom.scss',
//     'assets/front/css/front-custom.css').
// sass('resources/assets/scss/custom-dark-mode.scss',
//     'assets/css/custom-dark-mode.css').
mix.copy('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css',
    'public/assets/css/bootstrap-datepicker/bootstrap-datepicker.css');
mix.babel('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
    'public/assets/js/bootstrap-datepicker/bootstrap-datepicker.js');

// mix.copy('node_modules/fullcalendar/main.min.css', 'public/assets/css/plugins/fullcalendar.bundle.css');
// mix.copy('node_modules/flatpickr/dist/flatpickr.css', 'public/assets/css/plugins/flatpickr.css');
// mix.copy('node_modules/flatpickr/dist/flatpickr.min.js', 'public/assets/js/plugins/flatpickr.js');
// mix.copy('node_modules/bootstrap-daterangepicker/daterangepicker.css', 'public/assets/css/plugins/daterangepicker.css');
// mix.copy('node_modules/bootstrap-daterangepicker/daterangepicker.js', 'public/assets/js/plugins/daterangepicker.js');

// mix.combine([
//     'node_modules/fullcalendar/main.js',
//     'node_modules/fullcalendar/locales-all.min.js',
// ], 'public/assets/js/plugins/fullcalendar.bundle.js');


//backend third-party js
mix.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'public/backend/js/vendor.js',
    'public/backend/js/3rd-party-custom.js',
    'node_modules/moment/min/moment.min.js',
    'node_modules/daterangepicker/moment.min.js',
    'node_modules/apexcharts/dist/apexcharts.js',
    'node_modules/fullcalendar/main.js',
    'node_modules/fullcalendar/locales-all.min.js',
    'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
    'node_modules/bootstrap-daterangepicker/daterangepicker.js',
    'node_modules/flatpickr/dist/flatpickr.min.js',
    'node_modules/intl-tel-input/build/js/utils.js',
    'node_modules/intl-tel-input/build/js/intlTelInput.js',
], 'public/js/third-party.js')

// backend third-party js
// mix.scripts([
//     'node_modules/datatables/media/js/jquery.dataTables.min.js',
//     'node_modules/moment/min/moment.min.js',
//     'node_modules/izitoast/dist/js/iziToast.min.js',
//     'node_modules/flatpickr/dist/flatpickr.min.js',
//     'node_modules/intl-tel-input/build/js/intlTelInput.js',
//     'node_modules/intl-tel-input/build/js/utils.js',
//     'node_modules/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js',
// ], 'public/js/third-party.js')


// mix.js('resources/assets/js/custom/custom.js',
//     'public/assets/js/custom/custom.js').
//     js('resources/assets/js/custom/input_price_format.js',
//         'public/assets/js/custom/input_price_format.js').
//     js('resources/assets/js/custom/sidebar_menu.js',
//         'public/assets/js/custom/sidebar_menu.js').
//     js('resources/assets/js/profile/create-edit.js',
//         'public/assets/js/profile/create-edit.js').
//     js('resources/assets/js/doctors/doctors.js',
//         'public/assets/js/doctors/doctors.js').
//     js('resources/assets/js/doctors/create-edit.js',
//         'public/assets/js/doctors/create-edit.js').
//     js('resources/assets/js/doctors/detail.js',
//         'public/assets/js/doctors/detail.js').
//     js('resources/assets/js/patients/detail.js',
//         'public/assets/js/patients/detail.js').
//     js('resources/assets/js/patients/doctor-patient-appointment.js',
//         'public/assets/js/patients/doctor-patient-appointment.js').
//     js('resources/assets/js/users/user-profile.js',
//         'public/assets/js/users/user-profile.js').
//     js('resources/assets/js/custom/custom-datatable.js',
//         'public/assets/js/custom/custom-datatable.js').
//     js('resources/assets/js/patients/patients.js',
//         'public/assets/js/patients/patients.js').
//     js('resources/assets/js/patients/create-edit.js',
//         'public/assets/js/patients/create-edit.js').
//     js('resources/assets/js/countries/countries.js',
//         'public/assets/js/countries/countries.js').
//     js('resources/assets/js/states/states.js',
//         'public/assets/js/states/states.js').
//     js('resources/assets/js/cities/cities.js',
//         'public/assets/js/cities/cities.js').
//     js('resources/assets/js/doctor_sessions/doctor_sessions.js',
//         'public/assets/js/doctor_sessions/doctor_sessions.js').
//     js('resources/assets/js/doctor_sessions/create-edit.js',
//         'public/assets/js/doctor_sessions/create-edit.js').
//     js('resources/assets/js/service_categories/service_categories.js',
//         'public/assets/js/service_categories/service_categories.js').
//     js('resources/assets/js/specializations/specializations.js',
//         'public/assets/js/specializations/specializations.js').
//     js('resources/assets/js/roles/roles.js',
//         'public/assets/js/roles/roles.js').
//     js('resources/assets/js/roles/create-edit.js',
//         'public/assets/js/roles/create-edit.js').
//     js('resources/assets/js/settings/settings.js',
//         'public/assets/js/settings/settings.js').
//     js('resources/assets/js/services/services.js',
//         'public/assets/js/services/services.js').
//     js('resources/assets/js/services/create-edit.js',
//         'public/assets/js/services/create-edit.js').
//     js('resources/assets/js/appointments/appointments.js',
//         'public/assets/js/appointments/appointments.js').
//     js('resources/assets/js/appointments/patient-appointments.js',
//         'public/assets/js/appointments/patient-appointments.js').
//     js('resources/assets/js/appointments/create-edit.js',
//         'public/assets/js/appointments/create-edit.js').
//     js('resources/assets/js/staff/staff.js',
//         'public/assets/js/staff/staff.js').
//     js('resources/assets/js/staff/create-edit.js',
//         'public/assets/js/staff/create-edit.js').
//     mix.js('resources/assets/js/dashboard/dashboard.js',
//         'public/assets/js/dashboard/dashboard.js').version();
//     js('resources/assets/js/dashboard/doctor-dashboard.js',
//         'public/assets/js/dashboard/doctor-dashboard.js').
//     js('resources/assets/js/doctor_appointments/doctor_appointments.js',
//         'public/assets/js/doctor_appointments/doctor_appointments.js').
//     js('resources/assets/js/doctor_appointments/calendar.js',
//         'public/assets/js/doctor_appointments/calendar.js').
//     js('resources/assets/js/appointments/patient-calendar.js',
//         'public/assets/js/appointments/patient-calendar.js').
//     js('resources/assets/js/appointments/calendar.js',
//         'public/assets/js/appointments/calendar.js').
//     js('resources/assets/js/custom/phone-number-country-code.js',
//         'public/assets/js/custom/phone-number-country-code.js').
//     js('resources/assets/js/currencies/currencies.js',
//         'public/assets/js/currencies/currencies.js').
//     js('resources/assets/js/visits/visits.js',
//         'public/assets/js/visits/visits.js').
//     js('resources/assets/js/visits/create-edit.js',
//         'public/assets/js/visits/create-edit.js').
//     js('resources/assets/js/visits/doctor-visit.js',
//         'public/assets/js/visits/doctor-visit.js').
//     js('resources/assets/js/clinic_schedule/create-edit.js',
//         'public/assets/js/clinic_schedule/create-edit.js').
//     js('resources/assets/js/visits/show-page.js',
//         'public/assets/js/visits/show-page.js').
//     js('resources/assets/js/fronts/sliders/slider.js',
//         'public/assets/js/fronts/sliders/slider.js').
//     js('resources/assets/js/fronts/sliders/create-edit-slider.js',
//         'public/assets/js/fronts/sliders/create-edit-slider.js').
//     js('resources/assets/js/fronts/medical-contact/enquiry.js',
//         'public/assets/js/fronts/medical-contact/enquiry.js').
//     js('resources/assets/js/fronts/subscribers/create.js',
//         'public/assets/js/fronts/subscribers/create.js').
//     js('resources/assets/js/fronts/faqs/faqs.js',
//         'public/assets/js/fronts/faqs/faqs.js').
//     js('resources/assets/js/fronts/front_patient_testimonials/front_patient_testimonials.js',
//         'public/assets/js/fronts/front_patient_testimonials/front_patient_testimonials.js').
//     js('resources/assets/js/fronts/front_patient_testimonials/create-edit.js',
//         'public/assets/js/fronts/front_patient_testimonials/create-edit.js').
//     js('resources/assets/js/fronts/enquiries/enquiry.js',
//         'public/assets/js/fronts/enquiries/enquiry.js').
//     js('resources/assets/js/fronts/subscribers/subscriber.js',
//         'public/assets/js/fronts/subscribers/subscriber.js').
//     js('resources/assets/js/fronts/cms/create.js',
//         'public/assets/js/fronts/cms/create.js').
//     js('resources/assets/js/fronts/appointments/book_appointment.js',
//         'public/assets/js/fronts/appointments/book_appointment.js').
//     js('resources/assets/js/patient_visits/patient-visit.js',
//         'public/assets/js/patient_visits/patient-visit.js').
//     js('resources/assets/js/transactions/transactions.js',
//         'public/assets/js/transactions/transactions.js').
//     js('resources/assets/js/transactions/patient-transactions.js',
//         'public/assets/js/transactions/patient-transactions.js').
//     js('resources/assets/js/fronts/front_home/front-home.js',
//         'public/assets/js/fronts/front_home/front-home.js').
//     js('resources/assets/js/google_calendar/google_calendar.js',
//         'public/assets/js/google_calendar/google_calendar.js').
//     js('resources/assets/js/reviews/review.js',
//         'public/assets/js/reviews/review.js').
//     js('resources/assets/front/js/front-language.js',
//         'public/assets/front/js/front-language.js').
//     js('resources/assets/js/custom/create-account.js',
//         'public/assets/js/custom/create-account.js').
//     js('resources/assets/js/live_consultations/live_consultations.js',
//         'public/assets/js/live_consultations/live_consultations.js').
//     js('resources/assets/js/custom/helper.js',
//         'public/assets/js/custom/helper.js').
//     version();

//backend page js
mix.js([
    'resources/assets/js/turbo.js',
    'resources/assets/js/custom/helper.js',
    'resources/assets/js/custom/custom.js',
    'resources/assets/js/custom/input_price_format.js',
    'resources/assets/js/custom/sidebar_menu.js',
    'resources/assets/js/profile/create-edit.js',
    'resources/assets/js/doctors/doctors.js',
    'resources/assets/js/doctors/create-edit.js',
    'resources/assets/js/doctors/detail.js',
    'resources/assets/js/patients/detail.js',
    'resources/assets/js/patients/doctor-patient-appointment.js',
    'resources/assets/js/users/user-profile.js',
    'resources/assets/js/patients/patients.js',
    'resources/assets/js/patients/create-edit.js',
    'resources/assets/js/countries/countries.js',
    'resources/assets/js/states/states.js',
    'resources/assets/js/cities/cities.js',
    'resources/assets/js/doctor_sessions/doctor_sessions.js',
    'resources/assets/js/doctor_sessions/create-edit.js',
    'resources/assets/js/service_categories/service_categories.js',
    'resources/assets/js/specializations/specializations.js',
    'resources/assets/js/roles/roles.js',
    'resources/assets/js/roles/create-edit.js',
    'resources/assets/js/settings/settings.js',
    'resources/assets/js/services/services.js',
    'resources/assets/js/services/create-edit.js',
    'resources/assets/js/appointments/appointments.js',
    'resources/assets/js/appointments/patient-appointments.js',
    'resources/assets/js/appointments/create-edit.js',
    'resources/assets/js/staff/staff.js',
    'resources/assets/js/staff/create-edit.js',
    'resources/assets/js/dashboard/dashboard.js',
    'resources/assets/js/dashboard/doctor-dashboard.js',
    'resources/assets/js/doctor_appointments/doctor_appointments.js',
    'resources/assets/js/doctor_appointments/calendar.js',
    'resources/assets/js/appointments/patient-calendar.js',
    'resources/assets/js/appointments/calendar.js',
    'resources/assets/js/custom/phone-number-country-code.js',
    'resources/assets/js/currencies/currencies.js',
    'resources/assets/js/visits/visits.js',
    'resources/assets/js/visits/create-edit.js',
    'resources/assets/js/visits/doctor-visit.js',
    'resources/assets/js/clinic_schedule/create-edit.js',
    'resources/assets/js/visits/show-page.js',
    'resources/assets/js/fronts/sliders/slider.js',
    'resources/assets/js/fronts/sliders/create-edit-slider.js',
    'resources/assets/js/fronts/medical-contact/enquiry.js',
    'resources/assets/js/fronts/subscribers/create.js',
    'resources/assets/js/fronts/faqs/faqs.js',
    'resources/assets/js/fronts/front_patient_testimonials/front_patient_testimonials.js',
    'resources/assets/js/fronts/front_patient_testimonials/create-edit.js',
    'resources/assets/js/fronts/enquiries/enquiry.js',
    'resources/assets/js/fronts/subscribers/subscriber.js',
    'resources/assets/js/fronts/cms/create.js',
    'resources/assets/js/fronts/appointments/book_appointment.js',
    'resources/assets/js/patient_visits/patient-visit.js',
    'resources/assets/js/transactions/transactions.js',
    'resources/assets/js/transactions/patient-transactions.js',
    'resources/assets/js/fronts/front_home/front-home.js',
    'resources/assets/js/google_calendar/google_calendar.js',
    'resources/assets/js/reviews/review.js',
    'resources/assets/front/js/front-language.js',
    'resources/assets/js/custom/create-account.js',
    'resources/assets/js/live_consultations/live_consultations.js',
], 'public/js/pages.js');


//front third-party js
mix.scripts([
    'resources/assets/front/js/jquery.min.js',
    'resources/assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/front/vendor/swiper/swiper.min.js',
    'resources/assets/front/vendor/magnific-popup/jquery.magnific-popup.js',
    'resources/assets/front/js/functions.js',
    'resources/assets/front/js/contact.js',
    'assets/js/custom/helper.js',
    'assets/front/js/front-language.js',
], 'public/js/front-third-party.js')

// front js
mix.js('resources/assets/js/fronts/sliders/slider.js',
    'public/assets/js/fronts/sliders/slider.js').js('resources/assets/js/fronts/sliders/create-edit-slider.js',
    'public/assets/js/fronts/sliders/create-edit-slider.js').js('resources/assets/js/fronts/medical-contact/enquiry.js',
    'public/assets/js/fronts/medical-contact/enquiry.js').js('resources/assets/js/fronts/subscribers/create.js',
    'public/assets/js/fronts/subscribers/create.js').js('resources/assets/js/fronts/faqs/faqs.js',
    'public/assets/js/fronts/faqs/faqs.js').js('resources/assets/js/fronts/front_patient_testimonials/front_patient_testimonials.js',
    'public/assets/js/fronts/front_patient_testimonials/front_patient_testimonials.js').js('resources/assets/js/fronts/front_patient_testimonials/create-edit.js',
    'public/assets/js/fronts/front_patient_testimonials/create-edit.js')
    .js('resources/assets/js/custom/input_price_format.js',
        'public/assets/js/custom/input_price_format.js').js('resources/assets/js/fronts/enquiries/enquiry.js',
    'public/assets/js/fronts/enquiries/enquiry.js').js('resources/assets/js/fronts/subscribers/subscriber.js',
    'public/assets/js/fronts/subscribers/subscriber.js').js('resources/assets/js/fronts/cms/create.js',
    'public/assets/js/fronts/cms/create.js').js('resources/assets/js/fronts/appointments/book_appointment.js',
    'public/assets/js/fronts/appointments/book_appointment.js').js('resources/assets/js/fronts/front_home/front-home.js',
    'public/assets/js/fronts/front_home/front-home.js').js('resources/assets/front/js/front-language.js',
    'public/assets/front/js/front-language.js').js('resources/assets/js/custom/helper.js',
    'public/assets/js/custom/helper.js').version();

// front css
mix.sass('resources/assets/front/scss/front-custom.scss',
    'assets/front/css/front-custom.css').version();
