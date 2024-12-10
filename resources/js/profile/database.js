import { createClient } from "@supabase/supabase-js";

const base = createClient('https://lovfwwjxgvibfjnuymzp.supabase.co', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImxvdmZ3d2p4Z3ZpYmZqbnV5bXpwIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzE0MjAyMDEsImV4cCI6MjA0Njk5NjIwMX0.vuYmEKldolSctgdpZ3-AtOugCIKGK4E6LeRfE4JAwVk');

base.channel('supabase_realtime')
    .on('postgres_changes', { event: "*", schema: 'public', table: 'r_usuarios_roles' }, () => {
        location.reload();
    })
    .on('postgres_changes', { event: "*", schema: 'public', table: 'usuarios' }, () => {
        location.reload();
    })
    .subscribe();
