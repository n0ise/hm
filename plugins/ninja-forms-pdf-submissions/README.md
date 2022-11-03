# Ninja Forms - PDF Form Submissions

## To build for deployment

- Run `git checkout -b release` to generate a clean branch to release.
- Run `composer update --prefer-dist --no-dev --optimize-autoloader --ignore-platform-reqs`
- Navigate to `./vendor/mpdf/mpdf/ttfonts` and remove all files that do not start with `DejaVu`
- Run `git add -f vendor` to force a commit of the vendor folder.
- Commit your changes and run `git tag [version]` to generate a new tag.
- Push the new tag to remote.
- Make sure to cleanup your local installation by running `git branch -D release` to avoid conflicts in future builds.

## FEATURES

- Attach PDF to Email
- Export Submission as PDF

## HOOKS

### ACTIONS

- nf_pdf_before_template_part
- nf_pdf_after_template_part

### Filters

- ninja_forms_submission_pdf_fetch_sequential_number
- ninja_forms_submission_pdf_fetch_date
- ninja_forms_submission_pdf_name
- ninja_forms_pdf_pre_user_value
- ninja_forms_pdf_field_value
- ninja_forms_pdf_field_value_wpautop
- nf_pdf_template_url
- nf_pdf_locate_template
- nf_sub_document_fields


## ADDON COMPATIBILITY

- File Uploads
- Table Editor

## Misc.

- Customizing the PDF Template
- TODO: Custom Template CSS
