<?php

namespace App\Helpers;

trait Searchable {
    private function buildWildCards($term) {
        if ($term == "") {
            return $term;
        }

        // Strip MySQL reserved symbols
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);
        foreach($words as $idx => $word) {
            // Add operators so we can leverage the boolean mode of
            // fulltext indices.
            $words[$idx] = "+" . $word . "*";
        }

        return implode(' ', $words);
    }

    protected function scopeSearch($query, $term) {
        $columns = implode(',', $this->searchable);

        // Boolean mode allows us to match john* for words starting with john
        $query->whereRaw(
            "MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)",
            $this->buildWildCards($term)
        );
        return $query;
    }
}
