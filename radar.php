<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_radar.php');

// Create the basic radar graph
$graph = new RadarGraph(800,600);
$graph->img->SetAntiAliasing();

// Set background color and shadow
$graph->SetColor("white");
$graph->SetShadow();

// Position the graph
$graph->SetCenter(0.4,0.55);

// Setup the axis formatting 	
$graph->axis->SetFont(FF_FONT1,FS_BOLD);

// Setup the grid lines
$graph->grid->SetLineStyle("solid");
$graph->grid->SetColor("lightgray");
$graph->grid->Show();
$graph->HideTickMarks();
		
// Setup graph titles
$graph->title->Set("Manager Activity");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

$graph->SetTitles(array('Zvonki(90)', 'Viziti(60)', 'Testdrive(30)', 'Dogovor(15)', 'Vidachi(12)'));

// Create the first radar plot		
$plot = new RadarPlot(array(70,80,60,90,71));
$plot->SetLegend("Nebilicin Michael");
$plot->SetColor("red","lightred");
$plot->mark->SetType(MARK_IMG_SBALL,'red');
// Start by specifying the proper URL targets
$targets  = array( "#1" , "#2" , "#3", "4", "5");
$targets2  = array( "#1" , "#2" , "#3", "4", "5");
$plot->mark->SetType( MARK_SQUARE );
$plot->SetCSIMTargets( $targets, $targets2 );
//$graph->Add( $radarplot );
$plot->SetFill(false);
$plot->SetLineWeight(0.4);



// Create the first radar plot		
$plot2 = new RadarPlot(array(70,80,60,90,71));
$plot2->SetLegend("Nebilicin Michael");
$plot2->SetColor("red","lightred");
$plot2->mark->SetType(MARK_IMG_SBALL,'red');
// Start by specifying the proper URL targets
$targets  = array( "#1" , "#2" , "#3", "4", "5");
$targets2  = array( "#1" , "#2" , "#3", "4", "5");
$plot2->mark->SetType( MARK_SQUARE );
$plot2->SetCSIMTargets( $targets, $targets2 );
//$graph->Add( $radarplot );
$plot2->SetFill(false);
$plot2->SetLineWeight(0.4);


// Add the plots to the graph
$graph->Add($plot);

// And output the graph
//$graph->Stroke();
$graph->StrokeCSIM(); 

?>
