
namespace App\Controller;

use App\Service\ApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    #[Route('/authors', name: 'authors')]
    public function index(Request $request): Response
    {
        $token = $request->getSession()->get('token');
        $authors = $this->apiClient->getAuthors($token);

        return $this->render('author/index.html.twig', [
            'authors' => $authors,
        ]);
    }

    #[Route('/authors/delete/{id}', name: 'author_delete')]
    public function delete(Request $request, int $id): Response
    {
        $token = $request->getSession()->get('token');
        $this->apiClient->deleteAuthor($token, $id);

        return $this->redirectToRoute('authors');
    }
}