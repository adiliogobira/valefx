<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension {
	public function getFilters(): array
	{
		return [
			// If your filter generates SAFE HTML, you should add a third
			// parameter: ['is_safe' => ['html']]
			// Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
			new TwigFilter('moeda', [$this, 'moeda']),
			new TwigFilter('getEstate', [$this, 'getEstate']),
			new TwigFilter('base64enc', [$this, 'base64enc']),
			new TwigFilter('base64dec', [$this, 'base64dec']),
			new TwigFilter('strreplace', [$this, 'strreplace']),
			new TwigFilter('notificacaoColor', [$this, 'notificacaoColor']),
		];
	}

	public function getFunctions(): array
	{
		return [
			new TwigFunction('function_name', [$this, 'getEstate']),
		];
	}

	public function getEstate($uf) {
        $uf = strtoupper($uf);
		switch ($uf) {
		case 'MG':
			$estado = 'Minas Gerais';
			break;
		case 'MA':
			$estado = 'Maranhão';
			break;
		case 'ES':
			$estado = 'Espirito Santo';
			break;
		case 'RJ':
			$estado = 'Rio de Janeiro';
			break;
		case 'PI':
			$estado = 'Piaui';
			break;
		case 'GO':
			$estado = 'Goias';
			break;
		case 'BA':
			$estado = 'Bahia';
			break;
		case 'SP':
			$estado = 'São Paulo';
			break;
		default:
			$estado = '';
			break;
		}
		return $estado;
	}

	public function base64enc($str){
		return base64_encode($str);
	}

	public function base64dec($str){
		return base64_decode($str);
	}

	public function strreplace($change, $to, $string){
		return str_replace($change, $to, $string);
	}

    public function moeda($valor){
        return number_format($valor, 2,',', '.');
    }

	public function notificacaoColor($status) {
		$classLabel = '';

		switch ($status) {
		case 'Encerrado':
			$classLabel = 'light text-dark';
			break;
		case 'Cancelado':
			$classLabel = 'dark';
			break;
		case 'Encaminhado':
			$classLabel = 'warning';
			break;
		case 'Nao respondido':
			$classLabel = 'danger';
		case 'Não respondido':
			$classLabel = 'danger';
			break;
		default:
			$classLabel = 'success';
			break;
		}
		return $classLabel;
	}
}
