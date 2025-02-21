namespace App\Controller;

use App\Form\LoginType;
use App\Service\ApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    #[Route('/login', name: 'login')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $token = $this->apiClient->login($data['email'], $data['password']);

            $request->getSession()->set('token', $token);
            return $this->redirectToRoute('authors');
        }

        return $this->render('login/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}