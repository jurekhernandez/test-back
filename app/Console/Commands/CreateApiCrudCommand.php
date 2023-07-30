<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
class CreateApiCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:create-crud {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea la base para crud de una entidad';

    /**
     * Execute the console command.
     */
    protected $files;
    public function __construct(Filesystem $files)
    {
        $this->files=$files;
        parent::__construct();
    }
    public function handle()
    {
        $entidad=$this->argument('name');
        if (empty($entidad)) {
            return $this->error('Nombre ingresado es invalido..!');
        }

         $this->createStoreRequest($entidad);
         $this->createUpdateRequest($entidad);
         $this->createController($entidad);
         $this->createBusiness($entidad);
         $this->createStoreDtoRequest($entidad);
         $this->createUpdateDtoRequest($entidad);
         $this->createService($entidad);
    return true;
    }


    private function createStoreRequest(string $entidad){
        $contenido="<?php
namespace App\Http\Requests\\".$entidad.";

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            '' => [''],
        ];
    }

    public function messages():array
    {
        return [
            'required'=>'El campo :attribute es requerido',
        ];
    }
}";
        $file = "StoreRequest.php";
        $folder="/Http/Requests/".$entidad."/";
        $this->createFile($folder, $file, $contenido);

    }

    private function createUpdateRequest(string $entidad){
        $contenido="<?php

namespace App\Http\Requests\\".$entidad.";

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        \$this->merge(['id' => \$this->route('id')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'property' => [],
            'id'=>['required']
            ];
    }

    public function messages():array
    {
        return[
            'required'=>'El campo :attribute es requerido',
        ];

    }
}
";
        $file = "UpdateRequest.php";
        $folder="/Http/Requests/".$entidad."/";
        $this->createFile($folder, $file, $contenido);

    }

    private function createController(string $entidad){
        $contenido="<?php

        namespace App\Http\Controllers;

        use App\Domain\Business\\".$entidad."Business;
        use App\Http\Requests\\".$entidad."\StoreRequest;
        use App\Http\Requests\\".$entidad."\UpdateRequest;
        use App\Http\Trait\ApiController;
        use Illuminate\Http\JsonResponse;

        class ".$entidad."Controller extends Controller
        {
            use ApiController;

            protected ".$entidad."Business \$business;
            public function __construct(".$entidad."Business \$business)
            {
                \$this->business = \$business;
            }
            public function store(StoreRequest \$storeRequest):JsonResponse
            {
                return \$this->business->store(\$storeRequest);
            }
            public function update(UpdateRequest \$updateRequest, int \$id):JsonResponse
            {
                return \$this->business->update(\$updateRequest, \$id);
            }
        }";
        $file = $entidad."Controller.php";
        $folder="/Http/Controllers/";
        $this->createFile($folder, $file, $contenido);

    }
    private function createBusiness(string $entidad){
        $contenido="<?php

namespace App\Domain\Business;

use App\Domain\Dto\Request\\".$entidad."\\".$entidad."StoreDtoRequest;
use App\Domain\Dto\Request\\".$entidad."\\".$entidad."UpdateDtoRequest;
use App\Helpers\Permissions;
use App\Helpers\Response;
use App\Helpers\ReturnId;
use App\Http\Requests\\".$entidad."\StoreRequest;
use App\Http\Requests\\".$entidad."\UpdateRequest;

use App\Http\Trait\Business;
use App\Services\\".$entidad."Service;
use Illuminate\Http\JsonResponse;

class ".$entidad."Business
{
    use Business;
    private ".$entidad."Service \$service;
    private readonly string \$action;

    public function __construct(".$entidad."Service \$service)
    {
        \$this->service = \$service;
        \$this->action='".$entidad."';
    }
    public function store(StoreRequest \$request):JsonResponse
    {
        if(Permissions::Can(\$request,'crear '.\$this->action)){
            \$dto = ".$entidad."StoreDtoRequest::fromApiRequest(\$request);
            \$".$entidad." = \$this->service->store(\$dto);
            \$".$entidad."Id = ReturnId::fromModel(\$".$entidad.");
            Return Response::created(\$".$entidad."Id);
        }else{
            return Response::Forbiden();
        }
    }
    public function update(UpdateRequest \$request, int \$id):JsonResponse
    {
        if(Permissions::Can(\$request,'actualizar '.\$this->action)){
            \$dto = ".$entidad."UpdateDtoRequest::fromApiRequest(\$request);
            \$".$entidad." = \$this->service->update(\$dto, \$id);
            if(!\$".$entidad.")
                return Response::NotFound();
            return Response::noContent();
        }else{
            return Response::Forbiden();
        }
    }
}
";
        $file = $entidad."Business.php";
        $folder="/Domain/Business/";
        $this->createFile($folder, $file, $contenido);
    }

    private function createStoreDtoRequest(string $entidad){
        $contenido="<?php
namespace App\Domain\Dto\Request\\".$entidad.";
use App\Http\Requests\\".$entidad."\StoreRequest;

class ".$entidad."StoreDtoRequest
{
    public function __construct(
        public readonly string \$property,
        public readonly int \$id_creador,
    ){}
    public static function fromApiRequest(StoreRequest \$storeRequest):".$entidad."StoreDtoRequest
    {
        return new self(
            property: \$storeRequest->validated(key: 'property'),
            id_creador: \$storeRequest->user()->id,
        );
    }
}
";
        $file = $entidad."StoreDtoRequest.php";
        $folder="/Domain/Dto/Request/".$entidad."/";
        $this->createFile($folder, $file, $contenido);
    }

    private function createUpdateDtoRequest(string $entidad){
        $contenido="<?php

namespace App\Domain\Dto\Request\\".$entidad.";

use App\Http\Requests\\".$entidad."\UpdateRequest;

class ".$entidad."UpdateDtoRequest
{
    public function __construct(
        public readonly string|null \$property,
        public readonly int \$id_modificador,
    ){}
    public static function fromApiRequest(UpdateRequest \$request):".$entidad."UpdateDtoRequest
    {
        return new self(
            property: \$request->get(key: 'nombre'),
            id_modificador: \$request->user()->id,
        );
    }
}

";
        $file = $entidad."UpdateDtoRequest.php";
        $folder="/Domain/Dto/Request/".$entidad."/";
        $this->createFile($folder, $file, $contenido);
    }


    private function createService(string $entidad){
        $contenido="<?php

namespace App\Services;

use App\Domain\Dto\Request\\".$entidad."\\".$entidad."StoreDtoRequest;
use App\Domain\Dto\Request\\".$entidad."\\".$entidad."UpdateDtoRequest;
use App\Domain\Entities\Tb".$entidad.";
use App\Http\Trait\Service;

class ".$entidad."Service
{
    use Service;
    protected Tb".$entidad."  \$entity;
    public function __construct(Tb".$entidad." \$model)
    {
        \$this->entity=\$model;
    }

    public function store(".$entidad."StoreDtoRequest \$storeDTO){
        return \$this->entity::create([
            'id_creador'=> \$storeDTO->id_creador,
            'property'=> \$storeDTO->property,
        ]);
    }

    public function update(".$entidad."UpdateDtoRequest \$request, int \$id){
        \$model = \$this->entity::find(\$id);
        if(!\$model)
            return false;
        return tap(\$model)->update([
            'property' => \$request->property ?? \$model->property,
            'id_modificador' => \$request->id_modificador,
        ]);
    }

}";
        $file = $entidad."Service.php";
        $folder="/Services/";
        $this->createFile($folder, $file, $contenido);

    }

    private function createFile($folder, $file, $contenido){
        $path=app_path();
        $fullFolderRoute=$path.$folder;
        $fullFileRoute=$fullFolderRoute.$file;

        if($this->files->isDirectory($fullFolderRoute)){
            if($this->files->isFile($fullFileRoute))
                return $this->error($file.' File Already exists!');

            if(!$this->files->put($fullFileRoute, $contenido))
                return $this->error($file.' Something went wrong!');

            $this->info("$file generated!");
        }else{
            $this->files->makeDirectory($fullFolderRoute, 0777, true, true);
            if(!$this->files->put($fullFileRoute, $contenido))
                return $this->error($file.' Something went wrong!!');
            $this->info("$file generated!");
        }
    return true;
    }

// fin clase
}
