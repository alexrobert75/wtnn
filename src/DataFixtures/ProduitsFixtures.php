<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\Marques;
use App\Entity\Produits;
use Cocur\Slugify\Slugify;
use App\Entity\TailleStock;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProduitsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $marques = [];

        $marque = new Marques;
        $marque->setNom('Nike');
        $marque->setDescription("Nike, Inc. is an American multinational corporation that is engaged in the design, development, manufacturing, and worldwide marketing and sales of footwear, apparel, equipment, accessories, and services. The company is headquartered near Beaverton, Oregon, in the Portland metropolitan area. It is the world's largest supplier of athletic shoes and apparel and a major manufacturer of sports equipment, with revenue in excess of US$46 billion in its fiscal year 2022.");
        $marque->setDateCrea(DateTime::createFromFormat('d/m/Y', '25/01/1964'));
        $marque->setLogo("https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Logo_NIKE.svg/1920px-Logo_NIKE.svg.png");
        $marques['Nike'] = $marque;
        $manager->persist($marque);

        $marque1 = new Marques;
        $marque1->setNom('Yeezy');
        $marque1->setDescription("Adidas Yeezy (or just Yeezy) was a fashion collaboration between American rapper, designer and entrepreneur Kanye West[a] and German sportswear company Adidas. It offered sneakers in limited edition colorways, as well as shirts, jackets, track pants, socks, slides, lingerie and slippers. The first shoe model was released in February 2015. Yeezy influenced and inspired a multitude of other fashion brands.");
        $marque1->setDateCrea(DateTime::createFromFormat('d/m/Y', '01/02/2015'));
        $marque1->setLogo("https://upload.wikimedia.org/wikipedia/commons/thumb/0/00/Adidas_Yeezy_Logo.png/1920px-Adidas_Yeezy_Logo.png");
        $marques['Yeezy'] = $marque1;
        $manager->persist($marque1);

        $marque2 = new Marques;
        $marque2->setNom('New Balance');
        $marque2->setDescription("New Balance Athletics, Inc. (NB), best known as simply New Balance, is one of the world's major sports footwear and apparel manufacturers. Based in Boston, Massachusetts, the multinational corporation was founded in 1906 as the New Balance Arch Support Company.");
        $marque2->setDateCrea(DateTime::createFromFormat('d/m/Y', '01/01/1906'));
        $marque2->setLogo("https://upload.wikimedia.org/wikipedia/commons/thumb/e/ea/New_Balance_logo.svg/1280px-New_Balance_logo.svg.png");
        $marques['NB'] = $marque2;
        $manager->persist($marque2);

        $slugify = new Slugify();

        $produits = [];

        $produit = new Produits();
        $produit->setNom('Dunk Low Black White');
        $produit->setSlug($slugify->slugify($produit->getNom()));
        $produit->setCategorie('Nike');
        $produit->setDescription("Dévoilée aux côtés des coloris UNLV et Sail Coast, cette Dunk Low se joint à la line-up de janvier, avec un coloris efficace pour commencer l'année !
        La Nike Dunk Low Black White arbore une tige en cuir blanc, rehaussée par des empiècements en cuir noir pour un contraste tout en sobriété. On retrouve un branding NIKE sur la languette et l'outsole. Le jeu de couleur Black & White se poursuit également sur les semelles de la silhouette.
        Dans une version misant sur la simplicité, cette nouvelle édition complète à merveille la gamme des Dunk Low, habituée des couleurs plus chaudes et originales !");
        $produit->setPrix('120');
        $produit->setPhotoUrl('https://cdn.shopify.com/s/files/1/2358/2817/products/dunk-low-black-white-822113_5000x.png?v=1638813882');
        $produit->setCouleur('Black/White');
        $produit->setRef('DD1391-100');
        $produit->setMarque($marques['Nike']);
        $produits[] = $produit;
        $manager->persist($produit);

        $produit1 = new Produits();
        $produit1->setNom('Air Jordan 4 Retro SB Pine Green');
        $produit1->setSlug($slugify->slugify($produit1->getNom()));
        $produit1->setCategorie('Air Jordan');
        $produit->setMarque($marque);
        $produit1->setDescription("Pour la Saint-Patrick, Nike SB et Jordan Brand joignent leurs forces sur une version revisitée du modèle iconique signé Tinker Hatfield.
        La Air Jordan 4 Retro SB Pine Green arbore une base en cuir blanc cassé aux superpositions de daim gris sur le mudguard qui nous rappelle la Military Black. Plusieurs détails verts tels que les oeillets, le heel-tab et la midsole offrent une ouche colorée à l'ensemble. Une gumsole beige aux détails blancs sublime le look 2.0. 
        Douce et épurée, cette nouvelle Air Jordan 4 se veut plus confortable que ses précédentes éditions grâce à des matériaux plus souples, parfaits pour skater (ou pas) ! ");
        $produit1->setPrix('220');
        $produit1->setPhotoUrl('https://cdn.shopify.com/s/files/1/2358/2817/products/nike-sb-air-jordan-4-pine-green-1_5000x.png?v=1678728244');
        $produit1->setCouleur('Sail/Green/White');
        $produit1->setRef('DR5415-103');
        $produits[] = $produit1;
        $manager->persist($produit1);

        $produit2 = new Produits();
        $produit2->setNom('Dunk High Panda (2021)');
        $produit2->setSlug($slugify->slugify($produit2->getNom()));
        $produit2->setCategorie('Nike');
        $produit->setMarque($marque);
        $produit2->setDescription("Après le succès incontestable de la Dunk Low Black White, Nike décline le coloris sur la version High de la silhouette de l'année 2021 !
        La Nike Dunk High Panda (2021) affiche une construction classique en cuir lisse. Une combinaison d’empiècements noirs et blancs apportent un aspect old school, en clin d'oeil au versions color-block de l'iconique pack Be True To Your School de 1985. La semelle bicolore, les lacets et la languette sont accordés pour un look contrastant.
        Déjà édité dans le passé, notamment en 2008 et 2016, le retour de ce coloris intemporel risque de rapidement devenir un must-have. 
        Note :Le branding sur la languette peut varier de couleur (noir, rouge ou rose) selon la date de production du produit.");
        $produit2->setPrix('160');
        $produit2->setPhotoUrl('https://cdn.shopify.com/s/files/1/2358/2817/products/DunkHighPanda_5000x.png?v=1654761330');
        $produit2->setCouleur('Black/White');
        $produit2->setRef('DD1869-103');
        $produits[] = $produit2;
        $manager->persist($produit2);

        $produit3 = new Produits();
        $produit3->setNom('LD Waffle Sacai Fragment Blue Void');
        $produit3->setSlug($slugify->slugify($produit3->getNom()));
        $produit3->setCategorie('Nike');
        $produit->setMarque($marque);
        $produit3->setDescription("L’emblématique Hiroshi Fujiwara, parrain du streetwear japonais s'associe à Chitose Abe la créatrice de Sacai afin de revisiter le classique de Nike : la LD Waffle.
        La Nike LD Waffle Sacai Fragment Blue Void se pare d'une empeigne en nylon bleu marine, ainsi que des superpositions en daim noir. On retrouve également bon nombre d’éléments doublés, à l’image de la languette, du swoosh latéral ou encore de la semelle intermédiaire. Le logo Fragment sur le mudguard, de même qu’un branding Sacai sur les talons, apportent la touche finale.
        Cette triple collaboration inédite entre le label Fragment x Sacai x Nikesuscite un grand intérêt sur les réseaux sociaux et s’annonce déjà comme une des plus grosses sorties de l’année !");
        $produit3->setPrix('230');
        $produit3->setPhotoUrl('https://cdn.shopify.com/s/files/1/2358/2817/products/ld-waffle-sacai-fragment-blue-void-794190_5000x.png?v=1638814062');
        $produit3->setCouleur('Blue/White');
        $produit3->setRef('DH2684-400');
        $produits[] = $produit3;
        $manager->persist($produit3);

        $produit4 = new Produits();
        $produit4->setNom('Dunk Low NBA 75th Anniversary Chicago Bulls');
        $produit4->setSlug($slugify->slugify($produit4->getNom()));
        $produit4->setCategorie('Nike');
        $produit->setMarque($marque);
        $produit4->setDescription("La marque au Swoosh célèbre les 75 ans de la création de la NBA ! Dévoilée aux côtés d'une édition Brooklyn Nets, la nouvelle low-top vient rendre hommage à l'équipe emblématique de Michael Jordan, les Chicago Bulls.
        La Nike Dunk Low NBA 75th Anniversary Chicago Bulls présente une empeigne en cuir blanc, rehaussée par des rappels de rouge sur la toebox et les œillets. On note plusieurs nuances de noir sur les lacets, le Swoosh et le talon. Une inscription '75th Anniversary' sur la languette vient peaufiner le tout.
        Une nouvelle Dunk Low au coloris d'ores et déjà symbolique : les fans de la silhouette devraient être ravis !");
        $produit4->setPrix('130');
        $produit4->setPhotoUrl('https://cdn.shopify.com/s/files/1/2358/2817/products/dunk-low-nba-75th-anniversary-chicago-bulls-831495_5000x.png?v=1638813895');
        $produit4->setCouleur('Red/White/Black');
        $produit4->setRef('DD3363-100');
        $produits[] = $produit4;
        $manager->persist($produit4);

        $produit5 = new Produits();
        $produit5->setNom('Yeezy 700 Wave Runner Solid Grey');
        $produit5->setSlug($slugify->slugify($produit5->getNom()));
        $produit5->setCategorie('Yeezy');
        $produit->setMarque($marque1);
        $produit5->setDescription("Le design de la Yeezy Wave Runner 700 est unique, c’est un peu le genre de sneakers qu’on aime ou qu’on déteste. Si vous êtes sur cette page, on devine que cette sneaker ne vous laisse pas indifférent.
        Composée d’un upper en toile grise et en daim bleu, la Yeezy Wave Runner 700 se distingue par sa semelle renforcée, agrémentée de note d’orange et de lacets jaunes clairs.
        Sortie en pré-commande sur Yeezy Supply lors du dévoilement de la Yeezy Season 5 et livrée courant du mois de novembre 2017, cette silhouette a mis quelque mois avant de convaincre l’univers streetwear.
        Aujourd’hui elle est en rupture de stock littéralement partout, on ne compte plus le nombre de personnes qui se mordent les doigts de ne pas avoir passé commande sur le site Yeezy Supply au moment de sa sortie.");
        $produit5->setPrix('430');
        $produit5->setPhotoUrl('https://cdn.shopify.com/s/files/1/2358/2817/products/yeezy-700-wave-runner-solid-grey-101579_5000x.png?v=1638814800');
        $produit5->setCouleur('Grey/White/Black');
        $produit5->setRef('B75571');
        $produits[] = $produit5;
        $manager->persist($produit5);

        $produit6 = new Produits();
        $produit6->setNom('Yeezy Boost 350 V2 Bone');
        $produit6->setSlug($slugify->slugify($produit6->getNom()));
        $produit6->setCategorie('Yeezy');
        $produit->setMarque($marques['Yeezy']);
        $produit6->setDescription("Le label de Kanye West nous dévoile un nouveau coloris minimaliste et épuré aux inspirations anatomiques. 
        La Adidas Yeezy Boost 350 V2 Bone se pare d'une empeigne monochrome en Primeknit blanc. Une bande transparente vient s’imprégner sur le côté extérieur et rompt l'aspect uniforme de la silhouette. Un heel-tab en tissu se pose sur le talon tandis qu'une semelle à la technologie BOOST finalise le design avant-gardiste. 
        Cette 350 V2 inédite se présente comme un must-have qui risque de vous accompagner tout au long de la saison ! ");
        $produit6->setPrix('330');
        $produit6->setPhotoUrl('https://cdn.shopify.com/s/files/1/2358/2817/products/Adidas-Yeezy-350-V2-Bone-Wethenew-1_2000x.png?v=1650366163');
        $produit6->setCouleur('White');
        $produit6->setRef(' HQ6316');
        $produits[] = $produit6;
        $manager->persist($produit6);

        $produit8 = new Produits();
        $produit8->setNom('550 White Nightwatch Green');
        $produit8->setSlug($slugify->slugify($produit8->getNom()));
        $produit8->setCategorie('New Balance');
        $produit->setMarque($marque2);
        $produit8->setDescription("Modèle rétro par excellence signé New Balance, la 550 se dévoile à travers un coloris épuré.
        La New Balance 550 White Nightwatch Green présente une tige composée de cuir premium blanc accompagnée de petites perforations et de détails, également en cuir, vert et jaune. Le renfort talon se distingue à travers un empiècement en cuir gris qui met en valeur un branding 'NB' vintage jaune en accord avec le 'N' latéral et la mention 550 sur l'avant du pied.
        Imaginée à l'origine pour le basketball, la 550 revient donc dans une déclinaison qui rappelle les couleurs de l'ancienne franchise NBA des Seattle Supersonics. ");
        $produit8->setPrix('180');
        $produit8->setPhotoUrl('https://cdn.shopify.com/s/files/1/2358/2817/products/550-white-nightwatch-green-1_2000x.png?v=1665658804');
        $produit8->setCouleur('White/Green');
        $produit8->setRef('BB550PWC');
        $produits[] = $produit8;
        $manager->persist($produit8);

        $produit8 = new Produits();
        $produit8->setNom('550 White Nightwatch Green');
        $produit8->setSlug($slugify->slugify($produit8->getNom()));
        $produit8->setCategorie('New Balance');
        $produit->setMarque($marque2);
        $produit8->setDescription("Modèle rétro par excellence signé New Balance, la 550 se dévoile à travers un coloris épuré.
        La New Balance 550 White Nightwatch Green présente une tige composée de cuir premium blanc accompagnée de petites perforations et de détails, également en cuir, vert et jaune. Le renfort talon se distingue à travers un empiècement en cuir gris qui met en valeur un branding 'NB' vintage jaune en accord avec le 'N' latéral et la mention 550 sur l'avant du pied.
        Imaginée à l'origine pour le basketball, la 550 revient donc dans une déclinaison qui rappelle les couleurs de l'ancienne franchise NBA des Seattle Supersonics. ");
        $produit8->setPrix('180');
        $produit8->setPhotoUrl('https://cdn.shopify.com/s/files/1/2358/2817/products/550-white-nightwatch-green-1_2000x.png?v=1665658804');
        $produit8->setCouleur('White/Green');
        $produit8->setRef('BB550PWC');
        $produits[] = $produit8;
        $manager->persist($produit8);


        $tailleStocks = [];
        for ($i = 0; $i < 100; $i++) {
            $tailleStock = new TailleStock();
            $tailleStock->setTaille($faker->numberBetween(36, 45));
            $tailleStock->setStock($faker->numberBetween(0, 50));
            $tailleStock->setIdProduit($faker->randomElement($produits));
            $tailleStocks[] = $tailleStock;
            $manager->persist($tailleStock);
        }

        $manager->flush();
    }
}
