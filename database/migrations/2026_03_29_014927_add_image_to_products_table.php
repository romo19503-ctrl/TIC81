public function up(): void
{
Schema::table('products', function (Blueprint $table) {
// Agregamos la columna 'image' de tipo texto (para links largos)
$table->text('image')->nullable()->after('price');
});
}

public function down(): void
{
Schema::table('products', function (Blueprint $table) {
$table->dropColumn('image');
});
}