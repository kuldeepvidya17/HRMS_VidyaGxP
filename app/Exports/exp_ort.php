<!-- // app/Exports/YourExport.php -->
namespace App\Exports;

use App\Models\YourModel; // Replace YourModel with your actual model
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class YourExport implements FromCollection
{
    use Exportable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }
}
