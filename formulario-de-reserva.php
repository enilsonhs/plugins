<?php
/**
 * Plugin Name: 2 - Formulário de Reserva
 * Author: Enilson Herminio - Global Sites
 * Description: Exibe um formulário de reserva e insere os dados no banco de dados.
 * Version: 2.0 - 18/12/2023
 */

// Shortcode para exibir o formulário
add_shortcode('formulario_reserva', 'exibir_formulario_reserva');

function exibir_formulario_reserva() {
    ob_start(); // Inicia o buffer de saída

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_reserva'])) {
        inserir_dados_reserva();
    }

    // Consultar o banco de dados para obter a lista de stands disponíveis
    global $wpdb;
    $table_name_estandes = $wpdb->prefix . 'estandes';
    $estandes_disponiveis = $wpdb->get_results("SELECT numero, area, rua, asa FROM $table_name_estandes WHERE status = 'NÃO'", ARRAY_A);
    ?>
	


    <script type="text/javascript">
        var estandesInfo = <?php echo json_encode($estandes_disponiveis); ?>;

        jQuery(document).ready(function($) {
            $('#Standsescolhidos').change(function() {
                var selectedStandNumbers = $(this).val();
                var foundEstande = false;

                $('#rua').val('');
                $('#asa').val('');

                for (var i = 0; i < estandesInfo.length; i++) {
                    if (selectedStandNumbers.includes(estandesInfo[i].numero)) {
                        $('#rua').val(estandesInfo[i].rua);
                        $('#asa').val(estandesInfo[i].asa);
                        foundEstande = true;
                        break;
                    }
                }

                if (!foundEstande) {
                    $('#rua').val('');
                    $('#asa').val('');
                }
            });
        });
    </script>



    <script>
        jQuery(document).ready(function($) {
            $("#cargoFuncaoDropdown").change(function() {
                if ($(this).val() == "Outro") {
                    $("#outroCargoLabel").show();
                } else {
                    $("#outroCargoLabel").hide();
                }
            });
        });
    </script>

    <style>
        /* CSS para fazer com que os campos do formulário e as etiquetas ocupem 100% da largura do contêiner */
        form label,
        form input[type="text"],
        form input[type="email"],
        form input[type="date"],
        form input[type="submit"],
        form select {
            display: block;
            width: 100%;
            box-sizing: border-box; /* garante que padding e border não adicionem largura adicional */
            margin-bottom: 10px; /* Espaçamento entre campos */
        }

        /* Estilização adicional para tornar os campos de entrada mais estéticos */
        form input[type="text"],
        form input[type="email"],
        form input[type="date"],
        form select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

    <style>
        .moldura {
            border: 1px solid #333 !important;
            padding: 20px !important;
            border-radius: 10px !important;
            margin: 20px 0;
        }

        .moldura h3 {
            font-size: 22px !important;
            margin-bottom: 10px !important;
            font-weight: bold !important;
        }

        .moldura h4 {
            font-size: 22px !important;
            margin-bottom: 20px !important;
            font-weight: normal !important;
        }
    </style>

<style>
    /* Estilos adicionais... */

    /* Estilização específica para o botão de enviar */
    form input[type="submit"] {
        background-color: #C48F31 !important; /* Cor de fundo */
        color: white !important; /* Cor do texto */
        padding: 10px 60px !important; /* Espaçamento interno (vertical 20px, horizontal 40px) */
        border: none !important; /* Sem borda */
        border-radius: 4px !important; /* Borda arredondada */
        cursor: pointer !important; /* Cursor de mãozinha */
        display: block !important; /* Faz o botão ocupar a largura total do container */
        margin: 0 auto !important; /* Centraliza o botão */
        width: fit-content !important; /* Ajusta a largura ao conteúdo do botão */
        text-align: center !important; /* Centraliza o texto no botão */
    }

    form input[type="submit"]:hover {
        background-color: #b0782a !important; /* Cor de fundo ao passar o mouse */
    }
</style>




<?
    ?>
    <form method="post" action="">
        <label>CNPJ: <input type="text" name="CNPJ" required></label><br>
        <label>Razao Social: <input type="text" name="Razao_Social" required></label><br>
        <label>Nome de Fantasia (nome na planta): <input type="text" name="Nome_Fantasia"></label>
        <label>Endereço: <input type="text" name="Endereco" required></label><br>
        <label>Numero: <input type="text" name="Numero" required></label><br>
        <label>Complemento: <input type="text" name="Complemento"></label><br>
        <label>Bairro: <input type="text" name="Bairro" required></label><br>
        <label>CEP: <input type="text" name="CEP" required></label><br>
        <label>Cidade: <input type="text" name="Cidade"></label><br>
		<label>UF:
			<select name="UF">
			<option value="AC">AC - Acre</option>
			<option value="AL">AL - Alagoas</option>
			<option value="AP">AP - Amapá</option>
			<option value="AM">AM - Amazonas</option>
			<option value="BA" selected>BA - Bahia</option>
			<option value="CE">CE - Ceará</option>
			<option value="DF">DF - Distrito Federal</option>
			<option value="ES">ES - Espírito Santo</option>
			<option value="GO">GO - Goiás</option>
			<option value="MA">MA - Maranhão</option>
			<option value="MT">MT - Mato Grosso</option>
			<option value="MS">MS - Mato Grosso do Sul</option>
			<option value="MG">MG - Minas Gerais</option>
			<option value="PA">PA - Pará</option>
			<option value="PB">PB - Paraíba</option>
			<option value="PR">PR - Paraná</option>
			<option value="PE">PE - Pernambuco</option>
			<option value="PI">PI - Piauí</option>
			<option value="RJ">RJ - Rio de Janeiro</option>
			<option value="RN">RN - Rio Grande do Norte</option>
			<option value="RS">RS - Rio Grande do Sul</option>
			<option value="RO">RO - Rondônia</option>
			<option value="RR">RR - Roraima</option>
			<option value="SC">SC - Santa Catarina</option>
			<option value="SP">SP - São Paulo</option>
			<option value="SE">SE - Sergipe</option>
			<option value="TO">TO - Tocantins</option>
		</select>
		</label><br>
        <label>Telefone: <input type="text" name="Fone"></label><br>
        <label>Celular: <input type="text" name="Celular" required></label><br>
        <label>Site: <input type="text" name="Site"></label><br>
		<h5><center>Representantes Legais</center></h5>
        <label>Nome: <input type="text" name="Representante1"  required></label><br>
        <label>CPF: <input type="text" name="CPFR1"  required></label><br>		
        <label>Nome: <input type="text" name="Representante2" ></label><br>
        <label>CPF: <input type="text" name="CPFR2" ></label><br>		
		<h5><center>Contatos</center></h5> 	
        <label><b>Principal: </b><input type="text" name="Nome1" required></label><br>
        <label>Telefone: <input type="text" name="Telefone1" required></label><br>
        <label>E-mail: <input type="email" name="Email1"  required></label><br>
		<label><b>Marketing: </b><input type="text" name="Nome2"></label><br>
        <label>Telefone: <input type="text" name="Telefone2" ></label><br>
        <label>E-mail: <input type="email" name="E-mail2"></label><br>
		<label><b>Financeiro: </b><input type="text" name="Nome3"></label><br>
        <label>Telefone: <input type="text" name="Telefone3"></label><br>
        <label>E-mail: <input type="email" name="E-mail3" ></label><br>
        <label>E-mail para envio de Nota Fiscal: <input type="email" name="emailnota"  required></label><br>
        <div class="moldura">
            <h5><center>Dados cadastrais do responsável pela assinatura do contrato digital (D4Sign) </center></h5>
            <h5><center>Preenchimento obrigatório:</center></h5>
            <label>Nome Completo: <input type="text" name="Nome"  required></label><br>
			<label>E-mail: <input type="email" name="emailassinatura"  required></label><br>
            <label>CPF: <input type="text" name="CPF1" required></label><br>
            <label>Cargo/Função do Participante:
                <select name="CargoFuncao" id="cargoFuncaoDropdown">
                    <option value="Proprietário/sócio">Proprietário/sócio</option>
                    <option value="Diretor">Diretor</option>
                    <option value="Gerente">Gerente</option>
                    <option value="Outro">Outro</option>
                </select>
            </label><br>
            <label id="outroCargoLabel" style="display: none;">Especifique: <input type="text" name="OutroCargo"></label><br>

            <label>Nome completo da Testemunha: <input type="text" name="NomeTestemunha"></label><br>
            <label>E-mail: <input type="email" name="EmailTestemunha" required></label><br>
            <label>CPF: <input type="text" name="CPF2" required></label><br>
        </div>

        <label>Porte / Faixa de Faturamento:
        <select name="porte_empresa">
            <option value="Empreendedor Individual – até R$ 81.000,00">Empreendedor Individual – até R$ 81.000,00</option>
            <option value="Microempresa – até R$ 360.000,00">Microempresa – até R$ 360.000,00</option>
            <option value="Empresa de Pequeno Porte – R$ 360.000,00 a R$ 4.800.000,00">Empresa de Pequeno Porte – R$ 360.000,00 a R$ 4.800.000,00</option>
            <option value="Empresa de Médio Porte – R$ 4.800.000,00 a R$ 6.000.000,00">Empresa de Médio Porte – R$ 4.800.000,00 a R$ 6.000.000,00</option>
            <option value="Empresa com faturamento acima de R$ 6.000.000,00 até R$ 20.000.000,00">Empresa com faturamento acima de R$ 6.000.000,00 até R$ 20.000.000,00</option>
        <option value="Empresa com faturamento acima de R$ 20.000.000,00">Empresa com faturamento acima de R$ 20.000.000,00</option>
        </select>
        </label><br>


<label>Ramo:
    <select name="Ramo" id="ramoSelect">
        <?php
        // Array de opções de Ramo
        $opcoes_ramo = array(
            "Adesivos, Impermeabilizantes e Selantes",
            "Isolamento Térmico e Acústico",
            "Argamassa, Cimento e Concreto",
            "Louças e Metais Sanitários",
            "Automação e Sistemas",
            "Máquinas e Equipamentos",
            "Climatização",
            "Material Elétrico",
            "Estruturas metálicas / Sistemas Construtivos",
            "Pinceis e Acessórios para Pintura",
            "Ferramentas Manuais, Elétricas e Eletrônicas",
            "Portas, Janelas e Esquadrias",
            "Fechaduras e Ferragens",
            "Revestimentos de Piso e Parede",
            "Formas",
            "Telhas e Coberturas",
            "Fios e Cabos",
            "Tintas, Solventes e Vernizes",
            "Hidráulica",
            "Tratamentos Sanitários",
            "Iluminação",
            "Tubos e Conexões",
            "Outro"
        );

        // Classificar as opções em ordem alfabética
        sort($opcoes_ramo);

        // Exibir as opções de seleção em ordem alfabética
        foreach ($opcoes_ramo as $opcao) {
            $opcao = esc_attr($opcao);
            $opcao_selecionada = selected($opcao, $_POST['Ramo'], false);

            echo '<option value="' . $opcao . '" ' . $opcao_selecionada . '>' . esc_html($opcao) . '</option>';
        }
        ?>
    </select>
</label><br>

<div id="outroRamoDiv" style="display: none;">
    <label>Especificar Ramo:</label>
    <input type="text" name="RamoOutro" id="outroRamoInput" value="<?php echo esc_attr($_POST['RamoOutro']); ?>">
</div>

<script>
    // Função para mostrar/ocultar o campo de especificar manualmente ao selecionar "Outro"
    jQuery(document).ready(function($) {
        $("#ramoSelect").change(function() {
            if ($(this).val() === "Outro") {
                $("#outroRamoDiv").show();
                // Limpar o valor do campo "RamoOutro" quando "Outro" é selecionado
                $("#outroRamoInput").val('');
            } else {
                $("#outroRamoDiv").hide();
            }
        });

        // Verificar o valor selecionado na inicialização
        if ($("#ramoSelect").val() === "Outro") {
            $("#outroRamoDiv").show();
        }
    });
</script>


<label>Setor:
    <select name="Setor" id="setorDropdown">
        <option value="Indústria">Indústria</option>
        <option value="Comércio">Comércio</option>
        <option value="Serviços">Serviços</option>
        <option value="Outro">Outro</option>
    </select>
</label><br>

<label id="outroSetorLabel" style="display: none;">Especifique: <input type="text" name="SetorOutro"></label><br>

<script>
    jQuery(document).ready(function($) {
        $("#setorDropdown").change(function() {
            if ($(this).val() == "Outro") {
                $("#outroSetorLabel").show();
            } else {
                $("#outroSetorLabel").hide();
            }
        });
    });
</script>



        <label>Funcionários: <input type="text" name="Funcionarios"></label><br>




    <!-- Aqui você insere o campo de seleção de estandes disponíveis -->
    <label>Selecione o Stand a ser reservado:</label><br>
    <select name="Standsescolhidos[]" multiple id="Standsescolhidos">
        <?php
        // Exibe as opções de seleção com base nos resultados da consulta
        foreach ($estandes_disponiveis as $estande) {
            $estande_numero = esc_attr($estande['numero']);
            $estande_area = esc_attr($estande['area']);
            $estande_selected = in_array($estande_numero, $_POST['Standsescolhidos']) ? 'selected' : '';

            echo '<option value="' . $estande_numero . '" data-area="' . $estande_area . '" ' . $estande_selected . '>' . esc_html($estande_numero) . '</option>';
        }
        ?>
    </select>
    <small style="font-size: 10px;">* Segure o CTRL se quiser selecionar mais de um Stand</small><br><br>

    <!-- Campo para exibir a área total -->
    <label>Área Total m²: <input type="text" name="AreaTotal" id="AreaTotal" readonly></label><br>


        <!-- Adicione um campo oculto para armazenar temporariamente os stands selecionados -->
        <input type="hidden" name="StandsSelecionadosHidden" id="StandsSelecionadosHidden" value="<?php echo esc_attr(implode(', ', $_POST['Standsescolhidos'])); ?>">

        <!-- Aqui você insere o código JavaScript para calcular e exibir a "AreaTotal" -->
    <script>
jQuery(document).ready(function($) {
    function calcularAreaTotal() {
        var areaTotal = 0;
        $('#Standsescolhidos option:selected').each(function() {
            areaTotal += parseFloat($(this).data('area'));
        });
        $('#AreaTotal').val(areaTotal.toFixed(2));

        // Check the value of AreaTotal and show/hide the additional field accordingly
        if (areaTotal > 0 && areaTotal < 13) {
            $('#tipoMontagemDiv').show(); // Show the additional field
        } else {
            $('#tipoMontagemDiv').hide(); // Hide the additional field
        }
    }

    $('#Standsescolhidos').change(function() {
        calcularAreaTotal();
    });

    // Calcular a área total inicial
    calcularAreaTotal();
        });
    </script>
<label>Rua: <input type="text" name="rua" id="rua" readonly ></label><br>
<label>Asa: <input type="text" name="asa" id="asa" readonly ></label><br>

<div id="tipoMontagemDiv" style="display: none;">
    <label>Tipo de Montagem:
        <select name="TipoMontagem" id="tipoMontagemDropdown">
            <option value="Basica">Básica</option>
            <option value="Upgrade">UPGRADE</option>
        </select>
    </label><br>
</div>

	
        <label>Condição de Pagamento:
            <select name="CondicaoPagamento" id="condicaoPagamentoDropdown">
                <option value="À vista">À vista</option>
                <option value="Parcelado">Parcelado</option>
            </select>
        </label><br>
        <div id="parcelasDiv" style="display: none;">
<label>Quantidade de Parcelas:
    <select name="Nparcelas" id="parcelasSelect">
        <option value="1">1x</option>
        <option value="2">2x</option>
        <option value="3">3x</option>
        <option value="4">4x</option>
        <option value="5">5x</option>
        <option value="6">6x</option>
        <option value="7">7x</option>
    </select>
</label><br>

        </div>

<!-- Adicione este código JavaScript abaixo para pegar Rua e Asa -->


<script>
    jQuery(document).ready(function ($) {
        $("#condicaoPagamentoDropdown").change(function () {
            if ($(this).val() === "Parcelado") {
                $("#parcelasDiv").show();
            } else {
                $("#parcelasDiv").hide();
            }
        });

        // Verifique a opção selecionada na inicialização
        if ($("#condicaoPagamentoDropdown").val() === "Parcelado") {
            $("#parcelasDiv").show();
        }
    });
</script>

<div id="dataParcelaDiv" style="display: none;">
    <label>Data 1ª Parcela: <input type="date" name="Data1Parcela"></label><br>
</div>

<script>
    jQuery(document).ready(function ($) {
        function toggleDataParcela() {
            if ($("#condicaoPagamentoDropdown").val() === "Parcelado") {
                $("#dataParcelaDiv").show();
            } else {
                $("#dataParcelaDiv").hide();
            }
        }

        $("#condicaoPagamentoDropdown").change(function () {
            toggleDataParcela();
        });

        // Verifique a opção selecionada na inicialização
        toggleDataParcela();
    });
</script>



        <label>Custo m²: <input type="text" name="CustoM2" id="ValorTotal" ></label><br>

<!-- Adicione este código JavaScript abaixo do seu campo Standsescolhidos -->
<script>
    jQuery(document).ready(function($) {
        // Função para calcular e exibir o ValorTotal
        function calcularValorTotal() {
            var standsEscolhidos = $("#Standsescolhidos").val();
            var standsEspecificos = ['1-10', '1-11', '1-20', '1-25', '1-26', '1-27', '1-30', '1-35', '1-37', '1-40', '1-45', '1-46', '1-47', '1-50', '1-55', '1-56', '1-57', '1-60', '1-65', '1-67', '1-70', '1-74', '2-07', '2-08', '2-10', '2-15', '2-20', '2-25', '2-26', '2-27', '2-30', '2-35', '2-40', '2-45', '2-46', '2-47', '2-50', '2-55', '2-56', '2-57', '2-60', '2-65', '3-07', '3-08', '3-10', '3-15', '3-20', '3-25', '3-26', '3-27', '3-30', '3-35', '3-40', '3-45', '3-46', '3-47', '3-55', '3-66', '3-70', '3-74', '3-78', '4-07', '4-08', '4-15', '4-20', '4-25', '4-26', '4-27', '4-30', '4-35', '4-40', '4-46', '4-50', '5-07', '5-10', '5-20', '5-26', '5-30', '5-40', '5-46'];
            var valorTotal;

            if (standsEscolhidos.some(stand => standsEspecificos.includes(stand))) {
                valorTotal = 400; // Se um dos stands específicos for escolhido
            } else {
                valorTotal = 776; // Valor padrão
            }

            // Exibe o valor calculado no campo ValorTotal
            $("#ValorTotal").val(valorTotal.toFixed(2));
        }

        // Atualiza o ValorTotal quando a página for carregada
        calcularValorTotal();

        // Atualiza o ValorTotal quando os stands forem alterados
        $('#Standsescolhidos').change(function() {
            calcularValorTotal();
        });
    });
</script>

        <label>Valor Total: <input type="text" name="ValorTotal" id="CustoM2"></label><br>



<div id="valorParcelaDiv">
    <label>Valor da Parcela: <input type="text" name="valordaparcela"></label><br>
</div>



        <label>Vendedor:
			<select name="vendedor" id="vendedor" required>
			<option value="IBS-Vando Barbosa">Vando Barbosa</option>
			<option value="IBS-Vera Santo">Vera Santo</option>
			<option value="IBS-Lays Caroliny">Lays Caroliny</option>
			<option value="IBS-Gláudia Alves">Gláudia Alves</option>
			<option value="IBS-Giovanna Alves">Giovanna Alves</option>
			<option value="Sem vendedor">Sem vendedor</option>
		</select>
		</label><br>


        <script>
    jQuery(document).ready(function($) {
        // Função para calcular o CustoM2
        function calcularCustoM2() {
            var areaTotal = parseFloat($("#AreaTotal").val());
            var standsEscolhidos = $("#Standsescolhidos").val();

            // Verifica se os stands escolhidos incluem algum dos stands específicos
            var standsEspecificos = ['1-10', '1-11', '1-20', '1-25', '1-26', '1-27', '1-30', '1-35', '1-37', '1-40', '1-45', '1-46', '1-47', '1-50', '1-55', '1-56', '1-57', '1-60', '1-65', '1-67', '1-70', '1-74', '2-07', '2-08', '2-10', '2-15', '2-20', '2-25', '2-26', '2-27', '2-30', '2-35', '2-40', '2-45', '2-46', '2-47', '2-50', '2-55', '2-56', '2-57', '2-60', '2-65', '3-07', '3-08', '3-10', '3-15', '3-20', '3-25', '3-26', '3-27', '3-30', '3-35', '3-40', '3-45', '3-46', '3-47', '3-55', '3-66', '3-70', '3-74', '3-78', '4-07', '4-08', '4-15', '4-20', '4-25', '4-26', '4-27', '4-30', '4-35', '4-40', '4-46', '4-50', '5-07', '5-10', '5-20', '5-26', '5-30', '5-40', '5-46'];
            var custoM2 = areaTotal * 776; // Valor padrão

            if (standsEscolhidos.some(stand => standsEspecificos.includes(stand))) {
                custoM2 = areaTotal * 400; // Se um dos stands específicos for escolhido
            }

            // Exibe o valor calculado no campo CustoM2
            $("#CustoM2").val(custoM2.toFixed(2));
        }

        // Atualiza o CustoM2 quando a página for carregada
        calcularCustoM2();

        // Atualiza o CustoM2 quando os stands forem alterados
        $('#Standsescolhidos').change(function() {
            calcularCustoM2();
        });
    });
</script>

<script>
    jQuery(document).ready(function($) {
        function calcularValorParcela() {
            var condicaoPagamento = $("#condicaoPagamentoDropdown").val();
            if (condicaoPagamento === "À vista") {
                $("#valorParcelaDiv").hide(); // Esconde o campo
                $("input[name='valordaparcela']").val(0); // Atribui valor 0
            } else {
                $("#valorParcelaDiv").show(); // Mostra o campo
                var valorTotal = parseFloat($("#CustoM2").val());
                var nParcelas = parseInt($("#parcelasSelect").val().replace('x', ''));
                var valorParcela = !isNaN(valorTotal) && !isNaN(nParcelas) && nParcelas > 0 ? valorTotal / nParcelas : valorTotal;
                $("input[name='valordaparcela']").val(valorParcela.toFixed(2));
            }
        }

        $("#CustoM2, #parcelasSelect, #condicaoPagamentoDropdown").change(calcularValorParcela);
        calcularValorParcela();
    });
</script>


        <input type="submit" name="submit_reserva" value="ENVIAR">
    </form>

   <!-- Aqui você insere o código JavaScript -->


<script>
    jQuery(document).ready(function($) {
        // Máscara para CNPJ
        $("input[name='CNPJ']").mask('00.000.000/0000-00');

        // Adicionando máscaras para CPF
        $("input[name='CPF1'], input[name='CPF2'], input[name='CPFR1'], input[name='CPFR2']").mask('000.000.000-00');

        // Máscara para telefones
        function applyPhoneMask(element){
            element.mask("(00) 0000-00009");
            element.blur(function(event) {
                if($(this).val().length == 15){ // Celular com 9 dígitos + DDD
                    element.mask("(00) 00000-0009");
                } else {
                    element.mask("(00) 0000-00009");
                }
            });
        }

        applyPhoneMask($("input[name='Fone']"));
        applyPhoneMask($("input[name='Celular']"));
        applyPhoneMask($("input[name='Celular2']"));
		applyPhoneMask($("input[name='Telefone1']"));
		applyPhoneMask($("input[name='Telefone2']"));
		applyPhoneMask($("input[name='Telefone3']"));

        // Máscara para CEP
        $("input[name='CEP']").mask('00000-000');
    });
</script>



    <?php
    return ob_get_clean(); // Finaliza e retorna o buffer de saída
}

function coletarRamo() {
    return isset($_POST['Ramo']) && $_POST['Ramo'] !== 'Outro' ? sanitize_text_field($_POST['Ramo']) : sanitize_text_field($_POST['RamoOutro']);
}

function add_months_to_date($date, $months_to_add) {
    $date_object = DateTime::createFromFormat('Y-m-d', $date);
    $date_object->modify("+$months_to_add month");
    return $date_object->format('Y-m-d');
}

function inserir_dados_reserva() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'reserva';
	
	$data1Parcela = sanitize_text_field($_POST['Data1Parcela']);
    $nParcelas = isset($_POST['Nparcelas']) ? (int)$_POST['Nparcelas'] : 1;

	

    if ($_POST['CargoFuncao'] == 'Outro') {
        $_POST['CargoFuncao'] = sanitize_text_field($_POST['OutroCargo']);
    }

    // Verifique se os stands foram selecionados
foreach ($_POST['Standsescolhidos'] as $stand_number) {
    $wpdb->update(
        $wpdb->prefix . 'estandes', // Nome correto da tabela
        ['status' => 'SIM'],       // Coluna e valor a ser atualizado
        ['numero' => $stand_number] // Critério de seleção (onde)
    );
}


    $areaTotal = isset($_POST['AreaTotal']) ? number_format((float)$_POST['AreaTotal'], 2, ',', '.') : '0,00';
    $custoM2 = isset($_POST['CustoM2']) ? number_format((float)$_POST['CustoM2'], 2, ',', '.') : '0,00';
    $valorParcela = isset($_POST['valordaparcela']) ? number_format((float)$_POST['valordaparcela'], 2, ',', '.') : '0,00';
    $valorTotal = isset($_POST['ValorTotal']) ? number_format((float)$_POST['ValorTotal'], 2, ',', '.') : '0,00';

	 $valordaparcela = isset($_POST['valordaparcela']) ? sanitize_text_field($_POST['valordaparcela']) : 0;

    // Coleta os dados do POST
    $data = array(
        'CNPJ' => sanitize_text_field($_POST['CNPJ']),
        'Razao_Social' => sanitize_text_field($_POST['Razao_Social']),
        'Nome_Fantasia' => sanitize_text_field($_POST['Nome_Fantasia']),
        'Endereco' => sanitize_text_field($_POST['Endereco']),
        'Numero' => sanitize_text_field($_POST['Numero']),
        'Complemento' => sanitize_text_field($_POST['Complemento']),
        'Bairro' => sanitize_text_field($_POST['Bairro']),
        'CEP' => sanitize_text_field($_POST['CEP']),
        'Cidade' => sanitize_text_field($_POST['Cidade']),
        'UF' => sanitize_text_field($_POST['UF']),
        'Fone' => sanitize_text_field($_POST['Fone']),
        'Celular' => sanitize_text_field($_POST['Celular']),
        'Site' => sanitize_text_field($_POST['Site']),
        'Representante1' => sanitize_text_field($_POST['Representante1']),
        'CPFR1' => sanitize_text_field($_POST['CPFR1']),
        'Representante2' => sanitize_text_field($_POST['Representante2']),
        'CPFR2' => sanitize_text_field($_POST['CPFR2']),
        'Nome1' => sanitize_text_field($_POST['Nome1']),
        'Email1' => sanitize_email($_POST['Email1']),
        'Telefone1' => sanitize_text_field($_POST['Telefone1']),
        'Nome2' => sanitize_text_field($_POST['Nome2']),
        'E-mail2' => sanitize_email($_POST['E-mail2']),
        'Telefone2' => sanitize_text_field($_POST['Telefone2']),
        'Nome3' => sanitize_text_field($_POST['Nome3']),
        'E-mail3' => sanitize_email($_POST['E-mail3']),
        'emailnota' => sanitize_email($_POST['emailnota']),		
        'Telefone3' => sanitize_text_field($_POST['Telefone3']),
        'Nome' => sanitize_text_field($_POST['Nome']),
        'emailassinatura' => sanitize_email($_POST['emailassinatura']),
        'CPF1' => sanitize_text_field($_POST['CPF1']),
        'CargoFuncao' => sanitize_text_field($_POST['CargoFuncao']),
        'NomeTestemunha' => sanitize_text_field($_POST['NomeTestemunha']),
        'EmailTestemunha' => sanitize_email($_POST['EmailTestemunha']),
        'CPF2' => sanitize_text_field($_POST['CPF2']),
        'Porte' => sanitize_text_field($_POST['porte_empresa']),
         'Ramo' => coletarRamo(),
        'Setor' => ($_POST['Setor'] == 'Outro') ? sanitize_text_field($_POST['SetorOutro']) : sanitize_text_field($_POST['Setor']),
        'Funcionarios' => sanitize_text_field($_POST['Funcionarios']),
        'Standsescolhidos' => sanitize_text_field(implode(', ', $_POST['Standsescolhidos'])),
        'AreaTotal' => sanitize_text_field($_POST['AreaTotal']),
		'rua' => sanitize_text_field($_POST['rua']),
		'asa' => sanitize_text_field($_POST['asa']),
		'TipoMontagem' => sanitize_text_field($_POST['TipoMontagem']),
        'CondicaoPagamento' => sanitize_text_field($_POST['CondicaoPagamento']),
        'Nparcelas' => sanitize_text_field($_POST['Nparcelas']),
        'Data1Parcela' => sanitize_text_field($_POST['Data1Parcela']), // Altere para sanitize_date se necessário e se for compatível com o formato de data.
        'CustoM2' => sanitize_text_field($_POST['CustoM2']),
        'vendedor' => sanitize_text_field($_POST['vendedor']),
        'ValorTotal' => sanitize_text_field($_POST['ValorTotal']),
		'valordaparcela' => sanitize_text_field($_POST['valordaparcela']) // Modificação em 06/12/2023

    );
	
	// Calcula as datas das parcelas subsequentes
    for ($i = 2; $i <= $nParcelas; $i++) {
        $data["Data{$i}Parcela"] = add_months_to_date($data1Parcela, $i - 1);
    }

    // Insere os dados na tabela
    $wpdb->insert($table_name, $data);
    ob_clean(); // Limpa o buffer de saída após a inserção

    if ($wpdb->insert_id) {
        // Envie um e-mail com as informações do formulário
	$to = 'enilsonhs@hotmail.com, vando.barbosa@guiafornecedoresic.com.br, financeiro@guiafornecedoresic.com.br, comercial@guiafornecedoresic.com.br';
    $subject = 'Formulário de Reserva - CONSTRUNORDESTE';

        // Construa a mensagem do e-mail com todos os campos do formulário
        $message = "Segue abaixo as informações do formulário de reserva:\n\n";
    $message .= "CNPJ: " . sanitize_text_field($_POST['CNPJ']) . "\n";
    $message .= "Razão Social: " . sanitize_text_field($_POST['Razao_Social']) . "\n";
    $message .= "Nome de Fantasia: " . sanitize_text_field($_POST['Nome_Fantasia']) . "\n";
    $message .= "Endereço: " . sanitize_text_field($_POST['Endereco']) . "\n";
    $message .= "Número: " . sanitize_text_field($_POST['Numero']) . "\n";
    $message .= "Complemento: " . sanitize_text_field($_POST['Complemento']) . "\n";
    $message .= "Bairro: " . sanitize_text_field($_POST['Bairro']) . "\n";
    $message .= "CEP: " . sanitize_text_field($_POST['CEP']) . "\n";
    $message .= "Cidade: " . sanitize_text_field($_POST['Cidade']) . "\n";
    $message .= "UF: " . sanitize_text_field($_POST['UF']) . "\n";
    $message .= "Telefone: " . sanitize_text_field($_POST['Fone']) . "\n";
    $message .= "Celular: " . sanitize_text_field($_POST['Celular']) . "\n";
    $message .= "Site: " . sanitize_text_field($_POST['Site']) . "\n";
    $message .= "Representante 1: " . sanitize_text_field($_POST['Representante1']) . "\n";	
    $message .= "CPF: " . sanitize_text_field($_POST['CPFR1']) . "\n";
    $message .= "Representante 2: " . sanitize_text_field($_POST['Representante2']) . "\n";	
    $message .= "CPF: " . sanitize_text_field($_POST['CPFR2']) . "\n";		
    $message .= "Pessoa para Contato (Principal): " . sanitize_text_field($_POST['Nome1']) . "\n";
    $message .= "Telefone: " . sanitize_text_field($_POST['Telefone1']) . "\n";
    $message .= "E-mail: " . sanitize_email($_POST['Email1']) . "\n";
    $message .= "Pessoa para Contato (Marketing): " . sanitize_text_field($_POST['Nome2']) . "\n";
    $message .= "Telefone: " . sanitize_text_field($_POST['Telefone2']) . "\n";
    $message .= "E-mail: " . sanitize_email($_POST['E-mail2']) . "\n";
    $message .= "Pessoa para Contato (Financeiro): " . sanitize_text_field($_POST['Nome3']) . "\n";
    $message .= "Telefone: " . sanitize_text_field($_POST['Telefone3']) . "\n";
    $message .= "E-mail: " . sanitize_email($_POST['E-mail3']) . "\n";	
    $message .= "E-mail para envio de Nota Fiscal: " . sanitize_email($_POST['emailnota']) . "\n";
    $message .= "Nome Completo: " . sanitize_text_field($_POST['Nome']) . "\n";
    $message .= "E-mail: " . sanitize_email($_POST['emailassinatura']) . "\n";
    $message .= "CPF: " . sanitize_text_field($_POST['CPF1']) . "\n";
    $message .= "Cargo/Função do Participante: " . sanitize_text_field($_POST['CargoFuncao']) . "\n";
    $message .= "Nome Completo da Testemunha: " . sanitize_text_field($_POST['NomeTestemunha']) . "\n";
	$message .= "E-mail Testemunha: " . sanitize_email($_POST['EmailTestemunha']) . "\n";
    $message .= "CPF: " . sanitize_text_field($_POST['CPF2']) . "\n";
    $message .= "Porte/Faixa de Faturamento: " . sanitize_text_field($_POST['porte_empresa']) . "\n";
    $message .= "Ramo: " . coletarRamo() . "\n";
    $message .= "Setor: " . ($_POST['Setor'] == 'Outro' ? sanitize_text_field($_POST['SetorOutro']) : sanitize_text_field($_POST['Setor'])) . "\n";
    $message .= "Funcionários: " . sanitize_text_field($_POST['Funcionarios']) . "\n";
    $message .= "Área Total m²: " . sanitize_text_field($_POST['AreaTotal']) . "\n";
    $message .= "Rua: " . sanitize_text_field($_POST['rua']) . "\n";	
    $message .= "Asa: " . sanitize_text_field($_POST['asa']) . "\n";
    $message .= "Tipo de Montagem: " . sanitize_text_field($_POST['TipoMontagem']) . "\n";
    $message .= "Stands escolhidos: " . sanitize_text_field(implode(', ', $_POST['Standsescolhidos'])) . "\n";
    $message .= "Condicao de Pagamento: " . sanitize_text_field($_POST['CondicaoPagamento']) . "\n";
    $message .= "Quantidade de Parcelas: " . sanitize_text_field($_POST['Nparcelas']) . "\n";
	$dataFormatada = date('d/m/Y', strtotime(sanitize_text_field($_POST['Data1Parcela'])));
	$message .= "Data 1ª Parcela: " . $dataFormatada . "\n";
    $message .= "Custo m²: " . sanitize_text_field($_POST['CustoM2']) . "\n";
    $message .= "Valor da Parcela: " . sanitize_text_field($_POST['valordaparcela']) . "\n";
    $message .= "Valor Total: " . sanitize_text_field($_POST['ValorTotal']) . "\n";
    $message .= "Vendedor: " . sanitize_text_field($_POST['vendedor']) . "\n";
        // Adicione todos os outros campos aqui, seguindo o mesmo padrão

        // Adicione o cabeçalho do e-mail
     $headers = 'From: Formulário CONSTRUNORDESTE Reserva <comercial@guiafornecedoresic.com.br' . "\r\n";


        // Envie o e-mail
        $mail_sent = wp_mail($to, $subject, $message, $headers);

        if ($mail_sent) {
            echo '<div style="text-align: center; font-size: 24px; font-weight: bold;">Reserva de Área solicitada com sucesso!<br>Em breve entraremos em Contato.</div>';
            echo '<meta http-equiv="refresh" content="5;url=https://guiafornecedoresic.com.br/">';
        } else {
            echo '<div style="text-align: center; font-size: 16px; font-weight: bold;">Erro ao enviar o e-mail.</div>';
        }
    } else {
        echo '<div style="text-align: center; font-size: 16px; font-weight: bold;">Erro ao inserir dados!</div>';
    }
}
?>