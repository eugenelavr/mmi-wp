# MMI Data Architecture Plugin

Custom WordPress plugin for the MMI University Portal. Registers Custom Post Types and ACF Field Groups for managing academic data.

## Features

### Custom Post Types

1. **Lecturers** (`lecturers`)
   - Викладачі кафедри з повною інформацією
   - Archive: `/lecturers/`
   - Single: `/lecturers/{slug}/`

2. **Courses** (`courses`)
   - Навчальні курси з силабусами
   - Archive: `/courses/`
   - Single: `/courses/{slug}/`

3. **Publications** (`publications`)
   - Наукові публікації викладачів
   - Archive: `/publications/`
   - Single: `/publications/{slug}/`

### ACF Field Groups

#### Lecturers Fields
- Position (посада)
- Degree (науковий ступінь)
- Contact info (email, phone, office)
- Scholar links (Google Scholar, ORCID, Scopus)
- **Relationships**: Courses, Publications

#### Courses Fields
- Course code (код курсу)
- Education level (бакалавр/магістр/аспірантура)
- Credits (ECTS)
- Semester
- Syllabus PDF
- Moodle link
- **Relationship**: Lecturer

#### Publications Fields
- Year (рік публікації)
- Type (журнал/конференція/книга/тощо)
- Authors (автори)
- Journal/venue (видання)
- Volume/issue, pages
- DOI, URL
- PDF file
- Indexing (Scopus, WoS, Google Scholar)

## Installation

The plugin is automatically loaded from `wp-content/plugins/mmi-data/`.

### Requirements
- WordPress 6.0+
- PHP 8.3+
- ACF Pro (for field groups to work)

### Activation

1. Install ACF Pro plugin first
2. Activate "MMI Data Architecture" plugin in WP Admin

## Data Architecture

### Relationships

```
Lecturers
  ├─→ Courses (many-to-many)
  └─→ Publications (many-to-many)

Courses
  └─→ Lecturer (many-to-one)
```

### Naming Convention

Following WordPress Coding Standards:
- **Slugs/Keys**: English, lowercase, underscores (`lecturer_position`)
- **Labels**: Ukrainian (`Посада`)
- **Text Domain**: `mmi-portal`

## Development

### File Structure

```
mmi-data/
├── mmi-data.php                 # Main plugin file
├── includes/
│   ├── post-types/
│   │   ├── lecturers.php       # Lecturers CPT
│   │   ├── courses.php         # Courses CPT
│   │   └── publications.php    # Publications CPT
│   └── acf/
│       ├── lecturers-fields.php    # Lecturers ACF group
│       ├── courses-fields.php      # Courses ACF group
│       └── publications-fields.php # Publications ACF group
└── README.md
```

### Adding New Fields

Edit the corresponding file in `includes/acf/` and add fields to the `acf_add_local_field_group()` array.

## Usage

After activation, three new menu items will appear in WP Admin:
- Викладачі (Lecturers)
- Курси (Courses)
- Публікації (Publications)

Use the relationship fields to connect:
- Lecturers → their Courses and Publications
- Courses → their Lecturer

## Notes

- All labels are in Ukrainian as per project requirements
- All field keys/slugs are in English for code maintainability
- Uses ACF Pro's `acf_add_local_field_group()` for version control
- Supports Gutenberg/Block Editor (`show_in_rest: true`)
