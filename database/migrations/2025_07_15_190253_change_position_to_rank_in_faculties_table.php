use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePositionToRankInFacultiesTable extends Migration
{
public function up()
{
// Use raw SQL for MariaDB/MySQL compatibility
DB::statement('ALTER TABLE faculties CHANGE position rank VARCHAR(255) NOT NULL');
}

public function down()
{
DB::statement('ALTER TABLE faculties CHANGE rank position VARCHAR(255) NOT NULL');
}
}