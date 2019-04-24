
<!DOCTYPE html
    <html lang="pt-br"> 
<head>    
    <meta charset="UTF-8"/>
    <meta name="description" content="Gestão Eletronico de Contrato">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" href="favicon.png">   
    <title>Controle de Acesso</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/css_portaria.css"/>
    <script type="text/javascript" src="js/jquery-1.6.4.js"></script>        
    <link href="css/aos.css" rel="stylesheet"/>
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <section id="container">
        <article id="article-left">

        </article>
        <article id="article-right">
            <div class="container-login">
                <div class="login">

                    <header class="header-login">
                        <h2 class="title-header-login">
                            <span class="title-form-login">CONTROLE DE ACESSO</span>
                        </h2>

                    </header>
                    <article class="article-login">
                        <div class="line-login">
                            <label class="title-login" for="login">USUÁRIO</label>
                            <div class="input-group-login"  id="input-group-login-user">
                                <input type="text" class="input-login" id="login" placeholder="DIGITE O USUÁRIO" autocomplete="off" >     
                            </div>
                        </div>
                        <div class="line-login">
                            <label class="title-login title-senha" for="senha">SENHA</label>
                            <!--<label class="title-login title-senha-right" id="esqueceu_senha">Esqueceu Senha?</label>-->
                            <div class="input-group-login" id="input-group-login-senha">
                                <input type="password" class="input-login" id="senha"  autocomplete="off"  placeholder="DIGITE A SENHA">     
                            </div>                         
                        </div>
                        <div class="line-login">
                            <div class="btn-login">
                                <input type="submit" class="bt-login" id="entrar" value="ENTRAR">     
                            </div>
                        </div>
                    </article>

                </div>
            </div>
        </article>
    </section>


    <script src="js/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#container').on('click', function () {
                if ($("#login").is(":focus")) {
                    $("#input-group-login-user").addClass("input-group-login-active");
                    $("#input-group-login-user").removeClass("input-group-login-error");
                } else {
                    $("#input-group-login-user").removeClass("input-group-login-active");
                }
                if ($("#senha").is(":focus")) {
                    $("#input-group-login-senha").addClass("input-group-login-active");
                    $("#input-group-login-senha").removeClass("input-group-login-error");
                } else {
                    $("#input-group-login-senha").removeClass("input-group-login-active");
                }
            });

        });
        $("#login").keydown(function () {
            $("#input-group-login-user").removeClass("input-group-login-error");
        });
        $("#senha").keydown(function () {
            $("#input-group-login-senha").removeClass("input-group-login-error");
        });
        $("#entrar").click(function () {
            callApi();
        });
        function callApi() {
            var login = $("#login").val();
            var senha = $("#senha").val();
            if (login.length <= 0) {
                $("#input-group-login-user").addClass("input-group-login-error");
            } else {
                $("#input-group-login-user").removeClass("input-group-login-error");
            }
            if (senha.length <= 0) {
                $("#input-group-login-senha").addClass("input-group-login-error");
            } else {
                $("#input-group-login-senha").removeClass("input-group-login-error");
            }
            if (login.length > 0 && senha.length > 0) {
                document.getElementById("entrar").value = "CONECTANDO...";
                $.ajax({
                    
                    url: "api.php", // ARQUIVO DE CHAMADA DE API
                    method: "post",
                    data: {request: "login",
                        login: login,
                        senha: senha
                    },
                    success: function (data)
                    {
                        //RETORNAR 00 OU ALGO QUE VALIDE O REDIRECT
                        var res = data.split(";");
                        if (typeof res[0] !== "undefined" && res[0] == "00") {
                            //00; SUCESSO
                            location.href = "painel.php";
                        } else if (typeof res[0] !== "undefined" && res[0] == "01") {
                            //01 USUARIO OU SENHA NAO ENCONTRADO
                            $("#input-group-login-user").addClass("input-group-login-error");
                            $("#input-group-login-senha").addClass("input-group-login-error");
                            document.getElementById("entrar").value = "ENTRAR";
                        } else {
                            //02 OU OUTRO, SENHA INCORRETA
                            $("#input-group-login-senha").addClass("input-group-login-error");
                            document.getElementById("entrar").value = "ENTRAR";
                        }
                    }
                });
            } else {
                document.getElementById("entrar").value = "ENTRAR";
            }
        }
    </script>
</body>
</html>