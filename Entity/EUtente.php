<?php
/**
 * La classe EUser contiene tutti gli attributi e metodi base che sono adoperati da tutte
 * le tipologie di utente. Contiene metodi per impostare, ottenere, validare i seguenti attributi:
 * - nickname: il nome utente utilizzato nell'applicazione
 * - mail: l'indirizzo utilizzato in fase di registrazione
 * - password: la password per accedere nell'applicazione
 * - info: oggetto EUserInfo contenente informazioni da modificare e visualizzabili nel profilo
 * - img: oggetto EImg contenente l'immagine da visualizzare nel profilo
 * @author gruppo2
 * @package Entity
 */

class EUtente extends EGenericObject
{
    private string $username;
    private string $password;
    private ?string $email;
    private bool $admin;

    /**
     * @return bool
     */
    public function getAdmin(): bool
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     */
    public function setAdmin(bool $admin): void
    {
        $this->admin = $admin;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }



}