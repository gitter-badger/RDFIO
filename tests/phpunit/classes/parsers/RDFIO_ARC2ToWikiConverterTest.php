<?php

class RDFIOARC2ToWikiConverterTest extends MediaWikiTestCase {
	
	protected function setUp() {
		parent::setUp();
	}
	
	protected function tearDown() {}

	
	public function testConvert() {
		$arc2rdfxmlparser = ARC2::getRDFXMLParser();
		$importData = $this->getTestImportData();
	
		$arc2rdfxmlparser->parseData( $importData );
	
		$triples = $arc2rdfxmlparser->triples;
		$tripleIndex = $arc2rdfxmlparser->getSimpleIndex();
		$namespaces = $arc2rdfxmlparser->nsp;
	
		$arc2towikiconverter = new RDFIOARC2ToWikiConverter();
		$wikiPages = $arc2towikiconverter->convert( $triples, $tripleIndex, $namespaces );
		// Debug stuff
		// echo "No of wiki pages: " . count($wikiPages);
	
		$this->assertEquals(11, count($wikiPages), "No wiki pages converted from triples!");
	}	
	
	
	function getTestImportData() {
		$testImportData = '<rdf:RDF
				xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
				xmlns:cd="http://www.recshop.fake/cd#"
				xmlns:countries="http://www.countries.org/onto/"
				xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
				>
	
				<rdf:Description
				rdf:about="http://www.recshop.fake/cd/Empire Burlesque">
				<cd:artist>Bob Dylan</cd:artist>
				<cd:country rdf:resource="http://www.countries.org/onto/USA"/>
				<cd:company>Columbia</cd:company>
				<cd:price>10.90</cd:price>
				<cd:year>1985</cd:year>
				</rdf:Description>
	
				<rdf:Description
				rdf:about="http://www.recshop.fake/cd/Hide your heart">
				<cd:artist>Bonnie Tyler</cd:artist>
				<cd:country>UK</cd:country>
				<cd:company>CBS Records</cd:company>
				<cd:price>9.90</cd:price>
				<cd:year>1988</cd:year>
				</rdf:Description>
	
				<rdf:Description
				rdf:about="http://www.countries.org/onto/USA">
				<rdfs:label>USA</rdfs:label>
				</rdf:Description>
	
				<rdf:Description rdf:about="http://www.countries.org/onto/Albums">
				<rdfs:subClassOf rdf:resource="http://www.countries.org/onto/MediaCollections"/>
				</rdf:Description>
				</rdf:RDF>';
		return $testImportData;
	}
		
}
