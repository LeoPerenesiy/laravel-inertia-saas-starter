import InviteMember from '@/components/team/InviteMember';
import TeamHeader from '@/components/team/TeamHeader';
import TeamMembers from '@/components/team/TeamMembers';

export default function TeamDashboard({ team, members }: { team: any, members:any; }) {
    return (
        <div className="space-y-6">
            <TeamHeader team={team} />
            <InviteMember />
            <TeamMembers members={members} />
        </div>
    );
}
