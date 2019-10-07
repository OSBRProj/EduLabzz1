<tbody>
        <tr>
            <td class="m_-8900661539877175813header" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:25px 0;text-align:center">
                <a target="_blank" href="{{ route('home') }}" style="height: 60px; width: auto;font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#bbbfc3;font-size:19px;font-weight:bold;text-decoration:none">
                    Jean Piaget
                </a>

            </td>
        </tr>

        <tr>
            <td class="m_-8900661539877175813body" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;border-bottom:1px solid #edeff2;border-top:1px solid #edeff2;margin:0;padding:0;width:100%">
                <table class="m_-8900661539877175813inner-body" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;margin:0 auto;padding:0;width:570px">

                    <tbody>
                        <tr>
                            <td class="m_-8900661539877175813content-cell" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
                                <h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left">
                                    Olá {{ $name }}!
                                </h1>
                                <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                    Você está recebendo este email, pois nós recebemos uma solicitação para resetar sua senha.
                                </p>
                                <table class="m_-8900661539877175813action" align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:30px auto;padding:0;text-align:center;width:100%">
                                    <tbody>
                                        <tr>
                                            <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                <table border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                                <a  target="_blank" href="{{ route('usuario.resetar-senha') }}/{{ $token }}" class="m_-8900661539877175813button m_-8900661539877175813button-blue" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-radius:3px;color:#fff;display:inline-block;text-decoration:none;text-decoration: none;background-color: #207adc;border-top: 10px solid #207adc;border-right: 18px solid #207adc;border-bottom: 10px solid #207adc;border-left: 18px solid #207adc;color: #444;font-weight: 700;font-size: 17px;">
                                                                                    Resetar senha
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                    Se você não fez uma solicitação para resetar senha, basta ignorar e excluir este email.
                                </p>
                                <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                    Atenciosamente,
                                    <br>
                                    Equipe Jean Piaget
                                </p>
                                <table class="m_-8900661539877175813subcopy" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-top:1px solid #edeff2;margin-top:25px;padding-top:25px">
                                    <tbody>
                                        <tr>
                                            <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;line-height:1.5em;margin-top:0;text-align:left;font-size:12px">
                                                    Se você estiver com problemas para clicar no botão de {{ "Resetarsenha" }}, copie e cole
                                                    o link abaixo em seu navegador:
                                                    <a target="_blank" href="{{ route('usuario.resetar-senha') }}/{{ $token }}" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#3869d4">
                                                        {{ route('usuario.resetar-senha') }}/{{ $token }}
                                                    </a>
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>

        <tr>
            <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                <table class="m_-8900661539877175813footer" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:0 auto;padding:0;text-align:center;width:570px">
                    <tbody>
                        <tr>
                            <td class="m_-8900661539877175813content-cell" align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
                                <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:center">
                                    © 2018 Jean Piaget. Todos os direitos reservados
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
