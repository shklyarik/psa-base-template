# MySQL Migrations

## Creating New Migrations

Create new migration using the CLI command:
```bash
php cli migrate:create --name="create_users_table"
```

Execute all migration:
```bash
php cli migrate:up --interactive=0"
```

## Available Column Types

The Psa\Migration library provides several helper methods for defining column types:

- `$this->primaryKey()` - Defines an `INT NOT NULL PRIMARY KEY AUTO_INCREMENT` column
- `$this->boolean()` - Creates a `TINYINT(1)` column with default value 0
- `$this->string($length = 255)` - Creates a `VARCHAR` column with optional length
- `$this->integer($length = null)` - Creates an `INT` column with optional length
- `$this->bigInteger($length = null)` - Creates a `BIGINT` column with optional length
- `$this->text()` - Creates a `TEXT` column
- `$this->datetime()` - Creates a `DATETIME` column
- `$this->date()` - Creates a `DATE` column
- `$this->float($precision = null, $scale = null)` - Creates a `FLOAT` column with optional precision and scale
- `$this->decimal($precision = null, $scale = null)` - Creates a `DECIMAL` column with optional precision and scale
- `$this->json()` - Creates a `JSON` column
- `$this->enum(array $values)` - Creates an `ENUM` column with the specified values

## Column Builder Options

Each column type can be customized with additional options:

- `->notNull()` - Makes the column NOT NULL
- `->defaultValue($value)` - Sets a default value
- `->unique()` - Makes the column unique
- `->length($length)` - Sets the length for string/integer columns
- `->precision($precision)` and `->scale($scale)` - Sets precision and scale for decimal/float columns
- `->pk()` - Sets the column as a primary key
- `->autoIncrement()` - Sets the column to auto-increment (typically used with primary keys)

## Available Migration Methods

### Creating and Dropping Tables
- `$this->createTable($tableName, $columns, $options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB')`
- `$this->dropTable($tableName)`

### Adding and Dropping Columns
- `$this->addColumn($tableName, $columnName, $type)`
- `$this->dropColumn($tableName, $columnName)`

### Managing Foreign Keys
- `$this->addForeignKey($name, $table, $columns, $refTable, $refColumns, $delete = null, $update = null)`
- `$this->dropForeignKey($name, $table)`

### Data Manipulation
- `$this->insert($tableName, $data)` - Insert records
- `$this->update($tableName, $data, $condition = null)` - Update records
- `$this->delete($tableName, $condition = null)` - Delete records

## Migration Structure

Each migration class must implement two methods:

- `up()` - Apply the migration changes
- `down()` - Revert the migration changes

The `down()` method should reverse ALL changes made in the `up()` method to ensure the database can be rolled back to a previous state.

## Example Migrations

### Simple table creation
```php
use Psa\Migration\Migration;

return new class extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull()->unique(),
            'email' => $this->string(100)->notNull(),
            'is_active' => $this->boolean()->defaultValue(true),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }
};
```

### Complex migration with multiple operations
```php
use Psa\Migration\Migration;

return new class extends Migration
{
    public function up()
    {
        // Create a new table
        $this->createTable('mail_accounts', [
            'id' => $this->primaryKey(),
            'is_enabled' => $this->boolean(),
            'smtp_host' => $this->string(255)->notNull(),
            'smtp_port' => $this->integer()->notNull(),
            'username' => $this->string(255)->notNull(),
            'password' => $this->string(255)->notNull(),
            'updated_at' => $this->datetime(),
            'created_at' => $this->datetime()->notNull(),
        ]);

        // Add columns to existing tables
        $this->addColumn('mailing_list', 'sent_at', $this->datetime());
        $this->addColumn('mailing_list', 'group_name', $this->string(100));

        // Add foreign key constraint
        $this->addForeignKey('fk_mailing_list_user', 'mailing_list', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        // Update existing records
        $this->update('mailing_list', ['group_name' => 'АБЗ'], ['=', 'sent_at', null]);

        // Insert initial data
        $this->insert('mail_accounts', [
            'is_enabled' => true,
            'smtp_host' => 'smtp.example.com',
            'smtp_port' => 587,
            'username' => 'user@example.com',
            'password' => 'secure_password',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        // Reverse operations in the opposite order
        $this->delete('mail_accounts', ['smtp_host' => 'smtp.example.com']);

        $this->update('mailing_list', ['group_name' => null], ['=', 'group_name', 'АБЗ']);

        $this->dropForeignKey('fk_mailing_list_user', 'mailing_list');

        $this->dropColumn('mailing_list', 'group_name');
        $this->dropColumn('mailing_list', 'sent_at');

        $this->dropTable('mail_accounts');
    }
};
```

## Best Practices

1. Always make sure your `down()` method completely reverses the `up()` method
2. Name your migration files descriptively to reflect what changes they make
3. Group related changes in a single migration when it makes sense
4. Test your migrations by running them up and down before applying to production
5. Always backup your database before running migrations in production
6. Keep your migrations idempotent when possible