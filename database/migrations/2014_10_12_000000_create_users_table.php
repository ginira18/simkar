    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('users', function (Blueprint $table) {
                // $table->id();
                $table->unsignedBigInteger('id')->primary();
                $table->string('email')->unique();
                $table->string('password');
                $table->enum('roles', ['super_admin', 'admin' , 'pegawai', 'presensi'])->default('pegawai');
                $table->rememberToken();
                $table->timestamps();

                $table->foreign('id')->references('id')->on('employees')->onDelete('cascade');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('users');
        }
    };
