
namespace App\Command;

use App\Service\ApiClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class AddAuthorCommand extends Command
{
    protected static $defaultName = 'app:add-author';
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $firstName = $helper->ask($input, $output, new Question('First Name: '));
        $lastName = $helper->ask($input, $output, new Question('Last Name: '));

        $token = $this->apiClient->login('ahsoka.tano@royal-apps.io', 'Kryze4President');
        $this->apiClient->addAuthor($token, $firstName, $lastName);

        $output->writeln('Author added successfully!');
        return Command::SUCCESS;
    }
}