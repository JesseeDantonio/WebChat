<?php

namespace Index\php\classes;

class ProfilePicture
{
    // Extensions autorisées
    private array $extensionsValid = array('jpg', 'jpeg', 'gif', 'png', 'svg');
    // Taille maximum du fichier en nombre d'octets ( ici 2 Mo )
    private int $sizeMax = 2097152;

    public function getExtensionsValid(): array
    {
        return $this->extensionsValid;
    }

    public function getSizeMax(): int
    {
        return $this->sizeMax;
    }

    public function getPathPictures(String $UUID, String $extensionUpload, String $path): String
    {
        return $path . $UUID . "." . $extensionUpload;
    }

    public function getExtension(String $nameFile): String
    {
        // strchr() ignore, supprime ce qui précède le "." donc on se retrouve avec ".[extension]"
        // ensuite substr() supprime le point qui était le premier caractère de la chaine
        // Enfin strtolower() transforme la chaine de caractère pour avoir que des minuscules
        return strtolower(substr(strchr($nameFile, "."), 1));
    }

    // Suppression de son image de profil, si elle existe.
    public function existPicture(String $UUID, String $path): bool
    {
        // On essaye de trouver une précedente image avec toutes les extensions autorisées, et l'uuid utilisateur.
        foreach ($this->extensionsValid as $extension) {
            // On vérifie si la combinaison avec l'extension existe
            if (file_exists($path . $UUID . "." . $extension)) {
                return true;
            }
        }
        return false;
    }

    public function deletePicture(String $UUID, String $path): bool
    {
        // On essaye de trouver une précedente image avec toutes les extensions autorisées, et l'uuid utilisateur.
        foreach ($this->extensionsValid as $extension) {
            // On vérifie si la combinaison avec l'extension existe
            if (file_exists($path . $UUID . "." . $extension)) {
                return unlink($path . $UUID . "." . $extension);
            }
        }
    }
}
