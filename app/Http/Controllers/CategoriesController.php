<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Categories::all();
        $xml = new \SimpleXMLElement('<categories></categories>');
        foreach ($categories as $category) {
            $node = $xml->addChild('category');
            $node->addChild('id', $category->id);
            $node->addChild('name', $category->name);
            $node->addChild('lft', $category->lft);
            $node->addChild('rgt', $category->rgt);
            $node->addChild('created_at', $category->created_at);
            $node->addChild('updated_at', $category->updated_at);
        }

        return response($xml->asXML(), 200, ['Content-Type' => 'application/xml']);
    }

    public function show($id)
    {
        $category = Categories::find($id);

        if (!$category) {
            return response('<error>Category not found.</error>', 404, ['Content-Type' => 'application/xml']);
        }

        $xml = new \SimpleXMLElement('<category></category>');
        $xml->addChild('id', $category->id);
        $xml->addChild('name', $category->name);
        $xml->addChild('lft', $category->lft);
        $xml->addChild('rgt', $category->rgt);
        $xml->addChild('created_at', $category->created_at);
        $xml->addChild('updated_at', $category->updated_at);

        return response($xml->asXML(), 200, ['Content-Type' => 'application/xml']);
    }
    public function store(Request $request)
    {

        $xmlPayload = $request->getContent();
        $obj = simplexml_load_string($xmlPayload);

        $category = new Categories();

        $category->name = $obj->name;;
        $category->lft = $obj->lft;
        $category->rgt = $obj->rgt;
        $category->save();

        $xml = new \SimpleXMLElement('<category></category>');
        $xml->addChild('id', $category->id);
        $xml->addChild('name', $category->name);
        $xml->addChild('lft', $category->lft);
        $xml->addChild('rgt', $category->rgt);
        $xml->addChild('created_at', $category->created_at);
        $xml->addChild('updated_at', $category->updated_at);

        return response($xml->asXML(), 201, ['Content-Type' => 'application/xml']);
    }

    public function update(Request $request, $id)
    {
        $xmlPayload = $request->getContent();
        $obj = simplexml_load_string($xmlPayload);

        $category = Categories::find($id);

        if (!$category) {
            return response('<error>Category not found.</error>', 404, ['Content-Type' => 'application/xml']);
        }

        $request->validate([
            'name' => 'required',
        ]);

        $category->name = $obj->name;
        $category->save();

        $xml = new \SimpleXMLElement('<category></category>');
        $xml->addChild('id', $category->id);
        $xml->addChild('name', $category->name);
        $xml->addChild('lft', $category->lft);
        $xml->addChild('rgt', $category->rgt);
        $xml->addChild('created_at', $category->created_at);
        $xml->addChild('updated_at', $category->updated_at);

        return response($xml->asXML(), 200, ['Content-Type' => 'application/xml']);
    }

    public function destroy($id)
    {
        $category = Categories::find($id);

        if (!$category) {
            return response('<error>Category not found.</error>', 404, ['Content-Type' => 'application/xml']);
        }

        $category->delete();

        return response('<message>Category deleted successfully.</message>', 200, ['Content-Type' => 'application/xml']);
    }
}
