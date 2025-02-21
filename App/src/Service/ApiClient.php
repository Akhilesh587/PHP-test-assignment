
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiClient
{
    private $client;
    private $baseUrl = 'https://candidate-testing.api.royal-apps.io/api/v2/';

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function login(string $email, string $password): string
    {
        $response = $this->client->request('POST', $this->baseUrl . 'login', [
            'json' => [
                'email' => $email,
                'password' => $password,
            ],
        ]);

        $data = $response->toArray();
        return $data['token_key'];
    }

    public function getAuthors(string $token): array
    {
        $response = $this->client->request('GET', $this->baseUrl . 'authors', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return $response->toArray();
    }

    public function deleteAuthor(string $token, int $authorId): bool
    {
        $response = $this->client->request('DELETE', $this->baseUrl . 'authors/' . $authorId, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return $response->getStatusCode() === 204;
    }

    public function getAuthorBooks(string $token, int $authorId): array
    {
        $response = $this->client->request('GET', $this->baseUrl . 'authors/' . $authorId . '/books', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return $response->toArray();
    }

    public function deleteBook(string $token, int $bookId): bool
    {
        $response = $this->client->request('DELETE', $this->baseUrl . 'books/' . $bookId, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return $response->getStatusCode() === 204;
    }

    public function addAuthor(string $token, string $firstName, string $lastName): bool
    {
        $response = $this->client->request('POST', $this->baseUrl . 'authors', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
            'json' => [
                'first_name' => $firstName,
                'last_name' => $lastName,
            ],
        ]);

        return $response->getStatusCode() === 201;
    }
}