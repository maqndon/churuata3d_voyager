@php
    
    function formatMaterials($materials)
    {
        // Check if $materials is an array, if not, convert it to an array.
        if (!is_array($materials) && !is_object($materials)) {
            return (string) $materials; // Return the input as a string.
        }
    
        // Convert objects to arrays.
        if (is_object($materials)) {
            $materials = json_decode(json_encode($materials), true);
        }
    
        // If it's an empty array or object, return an empty string.
    if (empty($materials)) {
        return '';
    }

    // Get the last item.
    $lastItem = array_pop($materials);

    // If there's only one item, return it as a string.
    if (empty($materials)) {
        return (string) $lastItem;
    }
    
    // Join the remaining items with ", " and append "or" before the last item.
    $formattedMaterials = implode(', ', $materials) . ' or ' . $lastItem;
    
    return $formattedMaterials;
    
    }

@endphp
