
namespace App\Controller;

use App\Service\ApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    #[Route('/books/delete/{id}', name: 'book_delete')]
    public function delete(Request $request, int $id): Response
    {
        $token = $request->getSession()->get('token');
        $this->apiClient->deleteBook($token, $id);

        return $this->redirectToRoute('author_view', ['id' => $request->query->get('author_id')]);
    }
}