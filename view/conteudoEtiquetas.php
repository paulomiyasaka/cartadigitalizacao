<div class="container">
  <div class="row">
    <div class="col text-center">
      <div id="aguarde" class="invisible">
        <p>Carregando <img src="img/load.gif" style="vertical-align: middle;"></p>
      </div>
    </div> 
  </div>
  <div class="row justify-content-center align-middle p-5">
    <div class="col-7 text-center">
      <h3>Gerar Planilha para Emissão de Etiquetas (PPN)</h3>
      <form id="form_gerar_plantilha_etiqueta" method="POST">
        <table id="tabela_etiqueta" class="table">
          <thead>
            <tr>
              <th scope="col">Selecione a SE</th>
              <th scope="col">Quantidade de Etiquetas</th>
              <th scope="col">Tipo Embalagem</th>    
              <th scope="col">Ação</th>                
            </tr>
          </thead>
          <tbody>
            <tr>
              <th class="mb-3">
                <select id="select_destinatarios" class="form-select" name="destinatarios[]" required>
                  <option value="" selected disabled>Selecione</option>
                </select>
              </th>
              <th class="mb-3">
                <input type="number" class="form-control w-50 mx-auto text-center" min="1" name="quantidade_etiqueta[]" required>
              </th>
              <th class="mb-3">
                <select id="select_embalagens" class="form-select" name="tipo_embalagem[]" required>
                  <option value="" selected disabled>Selecione</option>
                </select>
              </th>
              <th class="mb-3">
                <button onclick="adicionarLinha(this)" class="btn btn-light">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
        </svg>

                </button>
              </th>
            </tr>
          </tbody>
        </table>   
        <button type="submit" class="btn btn-outline-success">Gerar Planilha</button>
      </form>        
    </div>
  </div>   


<div id="listaPlanilhaEtiquetas"></div>

<div class="row justify-content-md-center">
  <div class="col-9">
<table class="table table-striped text-center">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Planilhas geradas nas últimas 12 horas</th>
      <!-- <th scope="col">Excluir</th> -->
    </tr>
  </thead>
  <tbody>


<?php
$dir = "planilhaEtiquetas/";
$diretorio = dir($dir);
$tabela = "";
$i = 1;

$lista_arquivos = scandir($dir, 1);
foreach ($lista_arquivos as $key => $arquivo){
 $nome_arquivo = NULL;

  if($arquivo != "." && $arquivo != ".."){

    $nome_arquivo = explode(".", $arquivo);

    $tabela .= "<tr>"; 
    $tabela .= "<th scope=\"row\">".$i++."</th>";
    $tabela .= "<td><a href='".$dir.$arquivo."'>".$nome_arquivo[0]."</a></td>";
/*
    $tabela .= "<td class=\"\"><a href=\"#\" onclick=\"modalExcluirPPN('".$arquivo."');\" class=\"\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" fill=\"red\" class=\"bi bi-trash\" viewBox=\"0 0 16 16\">
  <path d=\"M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z\"/>
  <path d=\"M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z\"/>
</svg>
</td>";
*/
    }


  ?>

        
</tr>

<?php

}

echo $tabela;

?>

</tbody>
</table>

</div>
</div>






</div>
<br><br>