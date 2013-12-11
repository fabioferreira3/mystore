<?php 

class Application_Model_Correios{
	
	protected $nCdEmpresa;
	protected $sDsSenha;
	protected $nCdServico;
	protected $sCepOrigem;
	protected $sCepDestino;
	protected $nVlPeso;
	protected $nCdFormato;
	protected $nVlComprimento;
	protected $nVlAltura;
	protected $nVlLargura;
	protected $nVlDiametro;
	protected $sCdMaoPropria;
	protected $nVlValorDeclarado;
	protected $sCdAvisoRecebimento;
	protected $StrRetorno;
	protected $nIndicaCalculo;
	
	public function setCdEmpresa($nCdEmpresa){
		$this->nCdEmpresa = $nCdEmpresa;
		return $this;		
	}
	
	public function getCdEmpresa(){
		return $this->nCdEmpresa;		
	}
	
	public function setDsSenha($sDsSenha){
		$this->sDsSenha = $sDsSenha;
		return $this;
	}
	
	public function getDsSenha(){
		return $this->sDsSenha;
	}
	
	public function setCdServico($nCdServico){
		$this->nCdServico = $nCdServico;
		return $this;
	}
	
	public function getCdServico(){
		return $this->nCdServico;		
	}
	
	public function setCepOrigem($sCepOrigem){
		$this->sCepOrigem = $sCepOrigem;
		return $this;
	}
	
	public function getCepOrigem(){
		return $this->sCepOrigem;
	}
	
	public function setCepDestino($sCepDestino){
		$this->sCepDestino = $sCepDestino;
		return $this;
	}
	
	public function getCepDestino(){
		return $this->sCepDestino;
	}
	
	public function setVlPeso($nVlPeso){
		$this->nVlPeso = $nVlPeso;
		return $this;
	}
	
	public function getVlPeso(){
		return $this->nVlPeso;
	}
	
	public function setCdFormato($nCdFormato){
		$this->nCdFormato = $nCdFormato;
		return $this;
	}
	
	public function getCdFormato(){
		return $this->nCdFormato;
	}
	
	public function setVlComprimento($nVlComprimento){
		$this->nVlComprimento = $nVlComprimento;
		return $this;
	}
	
	public function getVlComprimento(){
		return $this->nVlComprimento;
	}
	
	public function setVlAltura($nVlAltura){
		$this->nVlAltura = $nVlAltura;
		return $this;
	}
	
	public function getVlAltura(){
		return $this->nVlAltura;
	}
	
	public function setVlLargura($nVlLargura){
		$this->nVlLargura = $nVlLargura;
		return $this;
	}
	
	public function getVlLargura(){
		return $this->nVlLargura;
	}
	
	public function setVlDiametro($nVlDiametro){
		$this->nVlDiametro = $nVlDiametro;
		return $this;
	}
	
	public function getVlDiametro(){
		return $this->nVlDiametro;
	}
	
	public function setCdMaoPropria($sCdMaoPropria){
		$this->sCdMaoPropria = $sCdMaoPropria;
		return $this;
	}
	
	public function getCdMaoPropria(){
		return $this->sCdMaoPropria;		
	}
	
	public function setVlValorDeclarado($nVlValorDeclarado){
		$this->nVlValorDeclarado = $nVlValorDeclarado;
		return $this;
	}
	
	public function getVlValorDeclarado(){
		return $this->nVlValorDeclarado;		
	}
	
	public function setCdAvisoRecebimento($sCdAvisoRecebimento){
		$this->sCdAvisoRecebimento = $sCdAvisoRecebimento;
		return $this;
	}
	
	public function getCdAvisoRecebimento(){
		return $this->sCdAvisoRecebimento;		
	}
	
	public function setStrRetorno($StrRetorno){
		$this->StrRetorno = $StrRetorno;
		return $this;
	}
	
	public function getStrRetorno(){
		return $this->StrRetorno;
	}
	
	public function setIndicaCalculo($nIndicaCalculo){
		$this->nIndicaCalculo = $nIndicaCalculo;
		return $this;
	}
	
	public function getIndicaCalculo(){
		return $this->nIndicaCalculo;		
	}
	
	public function setConfig(){
		
		$this->setCdEmpresa('');
		$this->setDsSenha('');
		$this->setCdServico('40010,41106');
		$this->setCdFormato(1);
		$this->setVlComprimento('16');
		$this->setVlAltura('16');
		$this->setVlLargura('16');
		$this->setVlDiametro('16');
		$this->setCdMaoPropria('N');
		$this->setVlValorDeclarado('0');
		$this->setCdAvisoRecebimento('N');
		$this->setStrRetorno('XML');
		$this->setIndicaCalculo('3');
	}
	
	public function getPrecoPrazo($cepOrigem, $cepDestino, $peso = '0.5'){
		
		$this->setConfig();
		$this->setCepOrigem($cepOrigem);
		$this->setCepDestino($cepDestino);
		$this->setVlPeso($peso);
			
		$wsdlCorreios = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx?WSDL';
			
		$request = array(
				'nCdEmpresa'  => $this->getCdEmpresa(),
				'sDsSenha'  => $this->getDsSenha(),
				'nCdServico'  => $this->getCdServico(),
				'sCepOrigem'  => $this->getCepOrigem(),
				'sCepDestino'  => $this->getCepDestino(),
				'nVlPeso'  => $this->getVlPeso(),
				'nCdFormato'  => $this->getCdFormato(),
				'nVlComprimento'  => $this->getVlComprimento(),
				'nVlAltura'  => $this->getVlAltura(),
				'nVlLargura'  => $this->getVlLargura(),
				'nVlDiametro'  => $this->getVlDiametro(),
				'sCdMaoPropria'  => $this->getCdMaoPropria(),
				'nVlValorDeclarado'  => $this->getVlValorDeclarado(),
				'sCdAvisoRecebimento'  => $this->getCdAvisoRecebimento(),
				'StrRetorno'  => $this->getStrRetorno(),
				'nIndicaCalculo'  => $this->getIndicaCalculo()
		);
			
		$client = new SoapClient($wsdlCorreios, array(
				'trace' => true,
				'exceptions' => true,
				'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
				'connection_timeout' => 1000
		));
		$response = $client->CalcPrecoPrazo($request);
		$objeto = $response->CalcPrecoPrazoResult->Servicos->cServico;
		$result = array();
		
		$i=0;
		foreach ($objeto as $obj){
			$result[$i]['codigo'] = $obj->Codigo;
			if($obj->Codigo == '40010'){
				$result[$i]['nome'] = 'SEDEX';
			}else if($obj->Codigo == '41106'){
				$result[$i]['nome'] = 'PAC';
			}
			$result[$i]['valor'] = $obj->Valor;
			$result[$i]['prazo'] = $obj->PrazoEntrega;
			$i++;
		}
	
		return $result;
	}
	
}