<?php   function validarCPF($cpf) {
    // Remover caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
    // Verifica se o CPF tem 11 dígitos
    if(strlen($cpf) != 11) {
        return false;
    }
    
    // Verifica se todos os dígitos são iguais, o que não é permitido
    if(preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    
    // Calcula o primeiro dígito verificador
    for($i = 9; $i < 11; $i++) {
        $soma = 0;
        for($j = 0; $j < $i; $j++) {
            $soma += $cpf[$j] * (($i + 1) - $j);
        }
        $resto = $soma % 11;
        $digito = ($resto < 2) ? 0 : 11 - $resto;
        if($digito != $cpf[$i]) {
            return false;
        }
    }
    
    // Calcula o segundo dígito verificador
    for($i = 10; $i < 11; $i++) {
        $soma = 0;
        for($j = 0; $j < $i; $j++) {
            $soma += $cpf[$j] * (($i + 1) - $j);
        }
        $resto = $soma % 11;
        $digito = ($resto < 2) ? 0 : 11 - $resto;
        if($digito != $cpf[$i]) {
            return false;
        }
    }
    
    // CPF válido
    return true;
}

// Exemplo de uso:
$cpf = "14227682959";
if(validarCPF($cpf)) {
    echo "CPF válido.";
} else {
    echo "CPF inválido.";
}
?>