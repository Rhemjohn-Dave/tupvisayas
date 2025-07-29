use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangePositionToRankInFacultiesTable extends Migration
{
public function up()
{
// This works for MariaDB/MySQL < 8.0 DB::statement('ALTER TABLE faculties CHANGE position rank VARCHAR(255) NOT NULL');
    } public function down() { DB::statement('ALTER TABLE faculties CHANGE rank position VARCHAR(255) NOT NULL'); } }